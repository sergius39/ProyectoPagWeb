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
                  }else{
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


//MODAL DE CARRITO DE LA COMPRA
const openCartBtn = document.getElementById('openCartBtn');
const cartModal = document.getElementById('cartModal');
const closeBtn = document.querySelector('.closeCarrito');

// Abrir modal cuando se hace clic en el botón "Abrir Carrito"
openCartBtn.addEventListener('click', function() {
  cartModal.style.display = 'block';
});

// Cerrar modal cuando se hace clic en el botón de cierre
closeBtn.addEventListener('click', function() {
  cartModal.style.display = 'none';
});