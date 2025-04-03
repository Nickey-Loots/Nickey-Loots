document.addEventListener('DOMContentLoaded', function () {
    const orderTableBody = document.getElementById('order-table-body');

    function fetchOrders() {
        return JSON.parse(localStorage.getItem('orders')) || [];
    }

    function createOrderRow(item) {
        return `
            <tr>
                <td class="px-6 py-4">${item.naam}</td>
                <td class="px-6 py-4">€${item.prijs}</td>
            </tr>
        `;
    }

    function loadOrders() {
        const orders = fetchOrders();
        orderTableBody.innerHTML = '';

        orders.forEach(order => {
            order.items.forEach(item => {
                const row = createOrderRow(item);
                orderTableBody.insertAdjacentHTML('beforeend', row);
            });
        });
    }

    loadOrders();
});