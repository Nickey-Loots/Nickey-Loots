document.addEventListener('DOMContentLoaded', async function () {
    // Verkrijg referenties naar DOM-elementen
    const productTableBody = document.getElementById('product-table-body');
    const resetButton = document.getElementById('reset-button');
    const addProductButton = document.querySelector('[data-modal-toggle="crud-modal"]');
    const addProductForm = document.getElementById('add-product-form');

    // Haal producten op en render ze bij het laden van de pagina
    const products = await fetchProducts();
    renderProducts();

    // Event listener voor reset-knop
    resetButton.addEventListener('click', async function () {
        localStorage.removeItem('deletedProducts');
        resetProducts();
        const products = await fetchProducts(true);
        renderProducts(products);
    });

    // Event listener voor de knop om een product toe te voegen
    addProductButton.addEventListener('click', function () {
        addProductForm.reset();
    });

    // Event listener voor het indienen van het formulier om een product toe te voegen
    addProductForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const newProduct = getProductFormData();
        products.push(newProduct);
        localStorage.setItem('products', JSON.stringify(products));
        renderProducts();
        this.reset();
        document.querySelector('[data-modal-toggle="crud-modal"]').click();
    });

    // Event listener voor de annuleer-knop in de bewerk-modal
    document.getElementById('cancel-button').addEventListener('click', function () {
        closeEditModal();
    });

    // Event listener voor de knop om wijzigingen op te slaan in de bewerk-modal
    document.getElementById('save-changes-button').addEventListener('click', async function () {
        const updatedProduct = getEditFormData();
        updateProduct(updatedProduct);
        localStorage.setItem('products', JSON.stringify(products));
        closeEditModal();
        renderProducts();
        alert('Product succesvol bijgewerkt');
    });

    // Haal producten op uit local storage of JSON-bestand
    async function fetchProducts(reload = false) {
        let products = JSON.parse(localStorage.getItem('products'));
        if (!products || reload) {
            const response = await fetch('../public/js/producten.json');
            products = await response.json();
            localStorage.setItem('products', JSON.stringify(products));
        }
        return products;
    }

    // Render producten in de tabel
    function renderProducts() {
        const filteredProducts = filterDeletedProducts(products);
        productTableBody.innerHTML = '';
        filteredProducts.forEach(product => {
            productTableBody.innerHTML += createProductRow(product);
        });
        addDeleteEventListeners();
        addEditEventListeners();
    }

    // Verkrijg formuliergegevens voor nieuw product
    function getProductFormData() {
        return {
            id: getNextProductId(products),
            naam: document.getElementById('name').value,
            prijs: document.getElementById('price').value,
            img: document.getElementById('image-url').value
        };
    }

    // Verkrijg formuliergegevens voor bewerken product
    function getEditFormData() {
        return {
            id: document.getElementById('edit-product-id').value,
            naam: document.getElementById('edit-product-naam').value,
            prijs: document.getElementById('edit-product-prijs').value,
            img: document.getElementById('edit-product-img').value
        };
    }

    // Werk product bij in de producten array
    function updateProduct(updatedProduct) {
        const productIndex = products.findIndex(product => product.id == updatedProduct.id);
        if (productIndex !== -1) {
            products[productIndex] = updatedProduct;
        } else {
            alert('Product niet gevonden');
        }
    }

    // Maak HTML voor verwijderknop
    function createDeleteButton() {
        return `
            <button type="button" class="delete-button text-white bg-red-500
            hover:bg-red-800 font-medium
            rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Verwijder</button>
        `;
    }

    // Maak HTML voor wijzigknop
    function createEditButton() {
        return `
            <button type="button" id="wijzig-button" class="text-white bg-blue-700 hover:bg-blue-800
             font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2
            focus:outline-none">Wijzig</button>
        `;
    }

    // Maak een tabelrij voor een product
    function createProductRow(product) {
        return `
            <tr data-id="${product.id}">
                <td class="px-6 py-4">${product.id}</td>
                <td class="px-6 py-4">${product.naam}</td>
                <td class="px-6 py-4">€${product.prijs}</td>
                <td class="px-6 py-4">${product.img}</td>
                <td class="px-6 py-4">${createDeleteButton()}</td>
                <td class="px-6 py-4">${createEditButton()}</td>
            </tr>
        `;
    }

    // Voeg event listeners toe aan verwijderknoppen
    function addDeleteEventListeners() {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const itemToDelete = this.closest('tr');
                if (itemToDelete) {
                    const productId = itemToDelete.getAttribute('data-id');
                    itemToDelete.remove();
                    updateDeletedProducts(productId);
                }
            });
        });
    }

    // Voeg event listeners toe aan wijzigknoppen
    function addEditEventListeners() {
        document.querySelectorAll('#wijzig-button').forEach(button => {
            button.addEventListener('click', function () {
                const itemToEdit = this.closest('tr');
                if (itemToEdit) {
                    const productId = itemToEdit.getAttribute('data-id');
                    const productNaam = itemToEdit.querySelector('td:nth-child(2)').innerText;
                    const productPrijs = itemToEdit.querySelector('td:nth-child(3)').innerText.replace('€', '');
                    const productImg = itemToEdit.querySelector('td:nth-child(4)').innerText;

                    document.getElementById('edit-product-id').value = productId;
                    document.getElementById('edit-product-naam').value = productNaam;
                    document.getElementById('edit-product-prijs').value = productPrijs;
                    document.getElementById('edit-product-img').value = productImg;

                    document.getElementById('edit-modal').classList.remove('hidden');
                    document.getElementById('edit-modal').classList.add('flex');
                }
            });
        });
    }

    // Werk de lijst van verwijderde producten bij in local storage
    function updateDeletedProducts(productId) {
        let deletedProducts = JSON.parse(localStorage.getItem('deletedProducts')) || [];
        if (!deletedProducts.includes(productId)) {
            deletedProducts.push(productId);
            localStorage.setItem('deletedProducts', JSON.stringify(deletedProducts));
        }
    }

    // Filter verwijderde producten uit de lijst
    function filterDeletedProducts(products) {
        let deletedProducts = JSON.parse(localStorage.getItem('deletedProducts')) || [];
        return products.filter(product => !deletedProducts.includes(product.id.toString()));
    }

    // Verkrijg het volgende product ID
    function getNextProductId(products) {
        const maxId = products.reduce((max, product) => Math.max(max, product.id), 0);
        return maxId + 1;
    }

    // Reset producten in local storage
    function resetProducts() {
        localStorage.removeItem('products');
    }

    // Sluit de bewerk-modal
    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.getElementById('edit-modal').classList.remove('flex');
    }
});
