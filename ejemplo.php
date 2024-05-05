<?php
session_start();

// Inicializar las variables de sesión
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? ucfirst($_SESSION['nombreUsuario']) : null;
$emailUsuario = isset($_SESSION['emailUsuario']) ? $_SESSION['emailUsuario'] : null;
$idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;
$apellidoUsuario = isset($_SESSION['apellidoUsuario']) ? $_SESSION['apellidoUsuario'] : null;
$telefonoUsuario = isset($_SESSION['telefonoUsuario']) ? $_SESSION['telefonoUsuario'] : null;
$contraseñaUsuario = isset($_SESSION['passUsuario']) ? $_SESSION['passUsuario'] : null;

// Imprimir las variables de sesión
echo "Nombre de Usuario: " . $nombreUsuario . "<br>";
echo "Email de Usuario: " . $emailUsuario . "<br>";
echo "ID de Usuario: " . $idUsuario . "<br>";
echo "Apellido de Usuario: " . $apellidoUsuario . "<br>";
echo "Teléfono de Usuario: " . $telefonoUsuario . "<br>";
echo "Contraseña de Usuario: " . $contraseñaUsuario . "<br>";

?>
