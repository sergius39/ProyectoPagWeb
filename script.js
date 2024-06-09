// MODAL DE INICIO DE SESIÓN
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

document.addEventListener('DOMContentLoaded', function () {
    let cart = JSON.parse(localStorage.getItem('cart')) || {}; // Recuperar el contenido del carrito desde localStorage o crear un objeto vacío si no hay nada guardado

    const cartIcon = document.querySelector('.cart-icon');
    const cartCountElement = document.getElementById('cart-count');
    const addToCartButtons = document.querySelectorAll('.agregar-carrito');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.parentNode.getAttribute('data-id');
            const productName = button.parentNode.getAttribute('data-name');
            const productPrice = parseFloat(button.parentNode.getAttribute('data-price'));

            // Incrementar cantidad del producto en el carrito o agregar nuevo producto
            if (cart.hasOwnProperty(productId)) {
                cart[productId].quantity++;
            } else {
                cart[productId] = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                };
            }

            console.log("Contenido del carrito:", cart); // Mostrar el contenido del carrito en la consola
            updateCartCount();
            saveCartToLocalStorage(); // Guardar el contenido del carrito en localStorage
        });
    });

    // Actualizar el contador del carrito
    function updateCartCount() {
        let totalCount = 0;
        for (const productId in cart) {
            totalCount += cart[productId].quantity;
        }
        cartCountElement.textContent = totalCount;

        // Mostrar u ocultar el contador según sea necesario
        if (totalCount > 0) {
            cartCountElement.classList.remove('hidden');
        } else {
            cartCountElement.classList.add('hidden');
        }
    }

    // Guardar el contenido del carrito en localStorage
    function saveCartToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Recuperar el contenido del carrito del localStorage al cargar la página
    updateCartCount();

    // Redireccionar a la página de resumen de compra al hacer clic en la imagen del carrito
    cartIcon.addEventListener('click', () => {
        // Guardar el contenido del carrito en localStorage para poder recuperarlo en la página de resumen de compra
        localStorage.setItem('cart', JSON.stringify(cart));
        window.location.href = 'resumen.php'; // Redirigir al usuario a la página de resumen de compra
    });
});

window.addEventListener('scroll', function() {
    var header = document.querySelector('.menu');
    var scrollPosition = window.scrollY;

    if (scrollPosition > 0) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});