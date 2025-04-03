import { checkCartAmount } from './winkelwagen.js';

// Event listener voor DOMContentLoaded om ervoor te zorgen dat de code wordt uitgevoerd nadat de DOM volledig is geladen
document.addEventListener('DOMContentLoaded', async function () {
    const cartAmount = document.getElementById('cart-amount');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Controleer het aantal items in de winkelwagen
    checkCartAmount(cart, cartAmount);

    /**
     * Haal producten op uit localStorage of fetch ze van de server als ze niet in localStorage staan
     * @returns {Promise<Array>} Een belofte die een array van producten retourneert
     */
    async function fetchProducts() {
        let products = JSON.parse(localStorage.getItem('products'));
        if (!products) {
            const response = await fetch('./js/producten.json');
            products = await response.json();
            localStorage.setItem('products', JSON.stringify(products));
        }
        return products;
    }

    /**
     * Filter verwijderde producten uit de lijst van producten
     * @param {Array} products - De lijst van producten
     * @returns {Array} Een gefilterde lijst van producten
     */
    function filterDeletedProducts(products) {
        let deletedProducts = JSON.parse(localStorage.getItem('deletedProducts')) || [];
        return products.filter(product => !deletedProducts.includes(product.id.toString()));
    }

    /**
     * Maak een HTML-kaart voor een product
     * @param {Object} product - Het productobject
     * @returns {string} De HTML-string voor de productkaart
     */
    function createProductCard(product) {
        return `
            <div class="max-w-xs bg-white border border-gray-200 rounded-lg shadow flex flex-col min-h-full">
                <div class="w-full h-48 flex items-center justify-center">
                    <img class="max-h-full max-w-full" src="${product.img}" alt="${product.naam}" />
                </div>
                <div class="p-5 flex flex-col justify-between flex-grow">
                    <div class="flex-grow">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        ${product.naam}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">€${product.prijs}</p>
                    </div>
                    <button class="inline-flex px-3 mx-auto py-2 text-sm font-medium text-center text-white 
                    bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
                    modal-button" data-id="${product.id}" data-naam="${product.naam}" data-prijs="${product.prijs}">
                        Voeg toe aan winkelwagen
                    </button>
                </div>
            </div>
        `;
    }

    /**
     * Laad producten en voeg ze toe aan de pagina
     */
    async function loadProducts() {
        try {
            const data = await fetchProducts();
            const filteredData = filterDeletedProducts(data);
            const productContainer = document.getElementById('product-row');
            
            productContainer.classList.add('grid', 'grid-cols-1', 'sm:grid-cols-2', 'md:grid-cols-3',
                'lg:grid-cols-4', 'gap-4', 'p-4');

            filteredData.forEach(product => {
                const productCard = createProductCard(product);
                productContainer.insertAdjacentHTML('beforeend', productCard);
            });

            document.querySelectorAll('.modal-button').forEach(button => {
                button.addEventListener('click', addToCart);
            });
        } catch (error) {
            console.error('Error loading products:', error);
        }
    }

    /**
     * Voeg een product toe aan de winkelwagen
     * @param {Event} event - Het klikgebeurtenisobject
     */
    function addToCart(event) {
        const button = event.target;
        const productId = button.getAttribute('data-id');
        const productNaam = button.getAttribute('data-naam');
        const productPrijs = button.getAttribute('data-prijs');

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push({ id: productId, naam: productNaam, prijs: productPrijs, aantal: 1 });

        localStorage.setItem('cart', JSON.stringify(cart));
        checkCartAmount(cart, cartAmount);
        alert(`${productNaam} is toegevoegd aan de winkelwagen.`);
    }

    // Laad de producten bij het laden van de pagina
    loadProducts();
});
