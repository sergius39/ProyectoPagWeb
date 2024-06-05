document.addEventListener("DOMContentLoaded", function() {
    var cartItems = localStorage.getItem("cartItems");
    var checkoutItemsContainer = document.getElementById("checkoutItems");

    if (cartItems) {
        checkoutItemsContainer.innerHTML = cartItems;
    } else {
        checkoutItemsContainer.innerHTML = "<p>Tu carrito está vacío</p>";
    }

    function calcularTotal() {
        var total = 0;
        var cartItems = document.querySelectorAll(".cart-item");
        cartItems.forEach(function(item) {
            var priceString = item.querySelector("span").textContent.split(" - ")[1];
            var price = parseFloat(priceString.replace(" €", ""));
            var quantity = parseInt(item.querySelector(".quantity").textContent);
            total += price * quantity;
        });

        document.getElementById("total").textContent = "Total: $" + total.toFixed(2);
    }

    calcularTotal();

    var processPurchaseBtn = document.getElementById("processPurchaseBtn");
    processPurchaseBtn.addEventListener("click", function() {
        var cartData = [];
        var cartItems = document.querySelectorAll(".cart-item");
        cartItems.forEach(function(item) {
            var productId = item.getAttribute("data-id");
            var productName = item.querySelector("span").textContent.split(" - ")[0];
            var priceString = item.querySelector("span").textContent.split(" - ")[1];
            var price = parseFloat(priceString.replace(" €", ""));
            var quantity = parseInt(item.querySelector(".quantity").textContent);
            
            cartData.push({
                id: productId,
                name: productName,
                price: price,
                quantity: quantity
            });
        });

        console.log(cartData); // Mostrar el contenido del JSON en la consola

       var total = document.getElementById("total").textContent.split("$")[1];

        // Redirigir a insertarpedido.php con los datos del carrito como parámetros
        var url = "insertar_pedido.php";
        var formData = new FormData();
        formData.append("cartData", JSON.stringify(cartData));
        formData.append("total", total);
        window.location.href = url + "?cartData=" + JSON.stringify(cartData) + "&total=" + total;

    });

    // Event delegation para manejar eventos de eliminar producto
    checkoutItemsContainer.addEventListener("click", function(event) {
        if (event.target && event.target.classList.contains("eliminar-producto")) {
            var productItem = event.target.parentNode; // Obtener el elemento padre del botón eliminar (el div del producto en el carrito)
            var productId = productItem.getAttribute("data-id");
            
            // Eliminar el producto del DOM
            productItem.remove();
            
            // Eliminar el producto del almacenamiento local
            var cartItems = document.getElementById("checkoutItems").innerHTML;
            localStorage.setItem("cartItems", cartItems);
            
            calcularTotal(); // Recalcular el total después de eliminar un producto
        }
    });
});
