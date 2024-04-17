<?php
session_start();
include('conexion.php');

$usuario = $_POST["username"];
$contrasena = $_POST["password"];

// Consultar la base de datos para verificar si el usuario y la contraseña existen
$sql = "SELECT id FROM usuarios WHERE nombre = ? AND contraseña = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $contrasena); // "ss" indica que los parámetros son de tipo string

// Ejecutar la consulta
$stmt->execute();

// Vincular el resultado de la consulta a una variable
$stmt->bind_result($id_usuario);

// Recuperar el resultado
$stmt->fetch();

// Verificar si se encontró un usuario con la contraseña correspondiente
if ($id_usuario) {
    // El usuario y la contraseña existen en la base de datos
    echo "<p>Inicio de sesión exitoso.</p>";
} else {
    // El usuario o la contraseña no son válidos
    echo "<p>Usuario o contraseña incorrectos.</p>";
    $errorLogin = true;
}

$stmt->close();
$conn->close();

?>