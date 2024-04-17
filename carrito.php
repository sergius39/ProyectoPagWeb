<?php
session_start();

// Verificar si el carrito está inicializado en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para agregar un producto al carrito
function agregarProductoAlCarrito($id, $nombre, $precio) {
    if (array_key_exists($id, $_SESSION['carrito'])) {
        // Si el producto ya está en el carrito, aumentar la cantidad
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        // Si el producto no está en el carrito, agregarlo
        $_SESSION['carrito'][$id] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        ];
    }
}

// Manejar la solicitud de agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'agregar') {
    if (isset($_POST['id'], $_POST['nombre'], $_POST['precio'])) {
        agregarProductoAlCarrito($_POST['id'], $_POST['nombre'], $_POST['precio']);
    }
}

// Manejar la solicitud de vaciar el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'vaciar') {
    $_SESSION['carrito'] = [];
}

// Redirigir a la página de productos después de manejar las solicitudes del carrito
header('Location: productos.html');
exit();
?>
