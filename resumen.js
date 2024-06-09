document.addEventListener('DOMContentLoaded', function () {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const totalPriceElement = document.getElementById('total-price');
    const purchaseRow = document.getElementById('purchase-row');
    let totalPrice = 0;

    // Recuperar el contenido del carrito desde localStorage
    const cart = JSON.parse(localStorage.getItem('cart'));

    // Verificar si el carrito está vacío
    if (!cart || Object.keys(cart).length === 0) {
        emptyCartMessage.textContent = 'No tienes productos en tu carrito.';
        return;
    }

    // Mostrar los productos agregados al carrito
    for (const productId in cart) {
        const product = cart[productId];
        const totalProductPrice = product.price * product.quantity;
        const row = `
            <tr>
                <td>${capitalizeFirstLetter(product.name)}</td>
                <td class="text-center cantidad-content">
                    <button class="btn-inc-dec" onclick="updateQuantity('${productId}', -1)">-</button>
                    <span class="resumen-numero-responsive">${product.quantity}</span>
                    <button class="btn-inc-dec" onclick="updateQuantity('${productId}', 1)">+</button>
                </td>
                <td class="text-center">${product.price.toFixed(2)} €</td>
                <td class="text-center">${totalProductPrice.toFixed(2)} €</td>
            </tr>
        `;
        cartItemsContainer.insertAdjacentHTML('beforeend', row);

        // Calcular el precio total
        totalPrice += totalProductPrice;
    }

    // Mostrar el precio total
    totalPriceElement.textContent = totalPrice.toFixed(2) + ' €';

    // Mostrar el botón "Procesar Compra" si el carrito no está vacío
    if (Object.keys(cart).length > 0) {
        purchaseRow.style.display = 'table-row';
    }
});

function updateQuantity(productId, change) {
    const cart = JSON.parse(localStorage.getItem('cart'));
    if (!cart[productId]) return;

    cart[productId].quantity += change;

    if (cart[productId].quantity <= 0) {
        delete cart[productId];
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    location.reload();
}

function processPurchase() {
    const cart = JSON.parse(localStorage.getItem('cart'));
    const total = document.getElementById('total-price').textContent;

    fetch('insertar_pedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ cartData: cart, total: total })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.removeItem('cart');
            window.location.href = 'pedidoExito.php';
        } else {
            alert('Error al procesar la compra: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
