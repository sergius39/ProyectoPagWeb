//MODAL DE INICIO DE SESIÓN
var modalSesion = document.getElementById("ModalLogin");

// Función para abrir el modal
function openModal() {
    modalSesion.style.display = "block";
}

// Función para cerrar el modal y limpiar los campos
function closeModal() {
    limpiarCampos(); // Limpiar los campos de correo electrónico y contraseña al cerrar el modal
    limpiarMensajesError(); // Limpiar el mensaje de error al cerrar el modal
    modalSesion.style.display = "none";
}

// Función para limpiar los campos de correo electrónico y contraseña
function limpiarCampos() {
    document.getElementById("email").value = ""; // Limpiar el campo de correo electrónico
    document.getElementById("password").value = ""; // Limpiar el campo de contraseña
}

// Función para limpiar el mensaje de error
function limpiarMensajesError() {
    document.getElementById("error").innerText = ""; // Limpiar el contenido del elemento donde se muestra el mensaje de error
}

// Cuando el usuario haga clic en cualquier lugar fuera del modal, lo cerramos
window.onclick = function(event) {
    if (event.target == modalSesion) {
        closeModal();
    }
}

// Función para simular el proceso de inicio de sesión (aquí puedes agregar tu lógica de autenticación real)
function login() {
    // Obtener los valores del correo electrónico y la contraseña desde el formulario
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Realizar una petición AJAX al controlador_login.php para verificar el usuario y la contraseña
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Si la respuesta es exitosa, mostrar la respuesta en el modal
                var respuesta = JSON.parse(xhr.responseText);
                document.getElementById("error").innerText = respuesta.mensaje;
                // Si el inicio de sesión es exitoso, redirigir al usuario a la página de inicio
                if (respuesta.exito) {
                    if (respuesta.tipo === "admin") {
                        // Si es un administrador, redirigir a la página de administrador
                        window.location.href = "administrador.php";
                    } else {
                        window.location.href = 'index.php';
                    }
                }
            } else {
                // Si hay algún error, mostrar un mensaje de error genérico
                document.getElementById("error").innerText = 'Error al procesar la solicitud';
            }
        }
    };
    xhr.open('POST', 'controlador_login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('validar=true&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));

    return false; // Evitar que el formulario se envíe normalmente
}

document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al modal y al botón para abrirlo
    var modal = document.getElementById("cartModal");
    var openModalBtn = document.getElementById("openCartBtn");

    // Agregar evento al botón para abrir el modal
    openModalBtn.addEventListener("click", function() {
        modal.style.display = "block"; // Mostrar el modal al hacer clic en el botón
    });

    // Obtener referencia al botón para cerrar el modal
    var closeButton = document.querySelector(".close");

    // Agregar evento al botón para cerrar el modal
    closeButton.addEventListener("click", function() {
        modal.style.display = "none"; // Ocultar el modal al hacer clic en el botón de cerrar
    });

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    // Obtener referencia al contenedor de elementos del carrito
    var cartItemsContainer = document.getElementById("cartItems");

    // Función para agregar productos al carrito
    function addToCart(id, name, price) {
        var existingCartItem = document.querySelector(`.cart-item[data-id="${id}"]`);
        if (existingCartItem) {
            // Si el producto ya está en el carrito, aumentar su cantidad
            var quantityElement = existingCartItem.querySelector(".quantity");
            var currentQuantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentQuantity + 1;
        } else {
            // Si el producto no está en el carrito, agregarlo como nuevo
            agregarAlCarrito(id, name, price);
        }

        // Actualizar el total después de agregar un producto
        calcularTotal();
        toggleSummaryButton();
    }

    // Función para eliminar productos del carrito
    function removeFromCart(id) {
        var cartItem = document.querySelector(`.cart-item[data-id="${id}"]`);
        if (cartItem) {
            var quantityElement = cartItem.querySelector(".quantity");
            var currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity > 1) {
                quantityElement.textContent = currentQuantity - 1;
            } else {
                cartItemsContainer.removeChild(cartItem);
            }
            // Actualizar el total después de eliminar un producto
            calcularTotal();
            toggleSummaryButton();
        }
    }

    // Función para agregar un producto al carrito
    function agregarAlCarrito(id, name, price) {
        var cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");
        cartItem.setAttribute("data-id", id);

        var itemContent = `
            <span>${name} - ${price.toFixed(2)} €</span>
            <span class="quantity">1</span>
            <button class="eliminar-producto">Eliminar</button>
        `;
        cartItem.innerHTML = itemContent;

        cartItemsContainer.appendChild(cartItem);
    }

    // Función para calcular el total del precio en el carrito
    function calcularTotal() {
        var total = 0;
        var cartItems = document.querySelectorAll(".cart-item");
        cartItems.forEach(function(item) {
            var priceString = item.querySelector("span").textContent.split(" - ")[1]; // Obtener la parte del precio del texto
            var price = parseFloat(priceString.replace(" €", "")); // Eliminar el símbolo de euro
            var quantity = parseInt(item.querySelector(".quantity").textContent);
            total += price * quantity;
        });

        document.getElementById("total").textContent = "Total: $" + total.toFixed(2);
    }

    // Función para mostrar/ocultar el botón de resumen de compra según el contenido del carrito
    function toggleSummaryButton() {
        var summaryBtn = document.getElementById("summaryBtn");
        var cartItems = document.querySelectorAll(".cart-item");
        if (cartItems.length > 0) {
            summaryBtn.style.display = "block";
        } else {
            summaryBtn.style.display = "none";
        }
    }

    // Event delegation para manejar eventos de eliminar producto
    cartItemsContainer.addEventListener("click", function(event) {
        if (event.target && event.target.classList.contains("eliminar-producto")) {
            var productItem = event.target.parentNode; // Obtener el elemento padre del botón eliminar (el div del producto en el carrito)
            var productId = productItem.getAttribute("data-id");
            removeFromCart(productId);
        }
    });

    // Event delegation para manejar eventos de agregar producto
    document.body.addEventListener("click", function(event) {
        if (event.target && event.target.classList.contains("agregar-carrito")) {
            var product = event.target.parentNode; // Obtener el elemento padre del botón (el div.product)
            var productId = event.target.parentNode.getAttribute("data-id");
            var productName = product.querySelector("h3").textContent;
            var productPrice = parseFloat(product.querySelector(".precio").textContent.replace(" €", ""));
            addToCart(productId, productName, productPrice);
        }
    });

    // Obtener referencia al botón de resumen de compra
    var summaryBtn = document.getElementById("summaryBtn");

    // Agregar evento al botón de resumen de compra para redireccionar a checkout.php
    summaryBtn.addEventListener("click", function() {
        // Almacenar la información del carrito en el almacenamiento local
        var cartItemsHTML = cartItemsContainer.innerHTML;

        // Guardar la información del carrito en el almacenamiento local
        localStorage.setItem("cartItems", cartItemsHTML);

        // Redireccionar a checkout.php
        window.location.href = "checkout.php";
    });

    // Función para cerrar el modal del carrito
    function closeCartModal() {
        modal.style.display = "none";
    }

    // Asignar la función de cerrar modal del carrito al botón de cerrar
    document.querySelector(".close-cart-modal").addEventListener("click", closeCartModal);

    // Inicializar el estado del botón de resumen de compra
    toggleSummaryButton();
});
