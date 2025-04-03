/**
 * Werk het aantal items in de winkelwagen bij in de UI.
 * @param {Array} cart - De array met winkelwagen items.
 * @param {HTMLElement} cartAmount - Het HTML-element dat het aantal items in de winkelwagen weergeeft.
 */
export function checkCartAmount(cart, cartAmount) {
    if (cart.length > 0) {
        cartAmount.innerText = cart.length;
    } else {
        cartAmount.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const cartTableBody = document.getElementById('cart-items');
    const emptyCartButton = document.getElementById('emptyCart');
    const cartAmount = document.getElementById('cart-amount');
    const orderButton = document.getElementById('bestel');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    cartEmpty();

    /**
     * Groepeer winkelwagen items op basis van hun ID en tel hun hoeveelheden.
     * @param {Array} cart - De array met winkelwagen items.
     * @returns {Array} - De gegroepeerde winkelwagen items.
     */
    function groupCartItems(cart) {
        const groupedItems = {};
        cart.forEach(product => {
            if (groupedItems[product.id]) {
                groupedItems[product.id].aantal += 1;
            } else {
                groupedItems[product.id] = { ...product, aantal: 1 };
            }
        });
        return Object.values(groupedItems);
    }

    checkCartAmount(cart, cartAmount);

    /**
     * Maak een tabelrij voor een winkelwagen item.
     * @param {Object} product - Het product object.
     * @returns {string} - De HTML string voor de winkelwagen rij.
     */
    function createCartRow(product) {
        return `
            <tr class="odd:bg-white even:bg-gray-50 border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    ${product.naam}
                </th>
                <td class="px-6 py-4">
                    €${product.prijs * product.aantal}
                </td>
                <td class="px-6 py-4">
                    ${product.aantal}
                </td>
                <td class="px-6 py-4">
                    <button data-id="${product.id}" type="button" class="remove-item focus:outline-none 
                    text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
                    font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Verwijder</button>
                </td>
            </tr>
        `;
    }

    /**
     * Render de winkelwagen items in de UI.
     */
    function renderCart() {
        const groupedCart = groupCartItems(cart);
        cartTableBody.innerHTML = '';
        groupedCart.forEach(product => {
            const cartRow = createCartRow(product);
            cartTableBody.insertAdjacentHTML('beforeend', cartRow);
        });
    }

    /**
     * Werk de winkelwagen bij door een item te verwijderen en de winkelwagen opnieuw te renderen.
     * @param {string} productId - De ID van het product dat verwijderd moet worden.
     */
    function updateCart(productId) {
        cart = cart.filter(product => product.id.toString() !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
        checkCartAmount(cart, cartAmount);
        cartEmpty();
    }

    cartTableBody.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            const productId = event.target.getAttribute('data-id');
            updateCart(productId);
        }
    });

    emptyCartButton.addEventListener('click', function () {
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
        checkCartAmount(cart, cartAmount);
        cartEmpty();
    });

    orderButton.addEventListener('click', function () {
        let orders = JSON.parse(localStorage.getItem('orders')) || [];

        const newOrder = {
            id: Date.now(),
            items: cart,
            date: new Date().toISOString()
        };
        orders.push(newOrder);

        localStorage.setItem('orders', JSON.stringify(orders));

        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
        checkCartAmount(cart, cartAmount);

        alert('Bestelling is opgeslagen!');
        cartEmpty();
    });

    /**
     * Controleer of de winkelwagen leeg is en toon een bericht als dat zo is.
     */
    function cartEmpty() {
        if (cart.length === 0) {
            const empty = `
                <h1 class="text-lg text-red-600"> de winkelwagen is leeg</h1>
                `;
            cartTableBody.insertAdjacentHTML('beforeend', empty);
        } else {
            renderCart();
        }
    }

    renderCart();
});
