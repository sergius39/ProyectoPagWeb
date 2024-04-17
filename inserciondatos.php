<?php
session_start();
include ('conexion.php');

$sql = "INSERT INTO usuarios (email, nombre, apellido, telefono, contraseña) VALUES (?, ?, ?, ?, ?)";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Vincular los parámetros con los valores recibidos del formulario
$stmt->bind_param("sssis", $email, $nombre, $apellido, $telefono, $password);

// Asignar valores a los parámetros
$email = $_SESSION['email'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$telefono = $_SESSION['telefono']; 
$password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);


// Ejecutar la sentencia preparada
if ($stmt->execute()) {
  header("Location: registro_correcto.php");
} else {
  header("Location: registro_error.php");

}

// Cerrar la sentencia preparada y la conexión
$stmt->close();
$conn->close();
?>


















