<?php
session_start();
include 'conexion.php';

if (!empty($_POST['validar'])) {
    // Obtener el usuario y la contraseña del formulario
    $email = $_POST["email"];
    $contrasena = $_POST["password"];

    // Verificar si el usuario o la contraseña están vacíos
    if (empty($email) || empty($contrasena)) {
        echo json_encode(array("exito" => false, "mensaje" => "Por favor, introduce email y contraseña"));
        exit; // Detener la ejecución del script
    }

    // Consultar la base de datos para obtener la contraseña almacenada
    $sql = "SELECT id, nombre, contraseña FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" indica que el parámetro es de tipo string

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular el resultado de la consulta a variables
    $stmt->bind_result($idUsuario, $nombreUsuario, $contraseñaAlmacenada);

    // Recuperar el resultado
    $stmt->fetch();

    // Verificar si se encontró un usuario con el correo electrónico correspondiente
    if ($idUsuario) {
        // El usuario existe en la base de datos

        // Verificar si la contraseña proporcionada coincide con la almacenada
        if (password_verify($contrasena, $contraseñaAlmacenada)) {
            // La contraseña es correcta
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['emailUsuario'] = $email;
            $_SESSION['idUsuario'] = $idUsuario;

            echo json_encode(array("exito" => true, "mensaje" => "Inicio de sesión exitoso", "nombreUsuario" => $nombreUsuario));
        } else {
            // La contraseña es incorrecta
            echo json_encode(array("exito" => false, "mensaje" => "Email o contraseña incorrectos"));
        }
    } else {
        // El usuario no existe en la base de datos
        echo json_encode(array("exito" => false, "mensaje" => "Email o contraseña incorrectos"));
    }

    $stmt->close();
} else {
    // Si no se envió el formulario, mostrar un mensaje de error
    echo json_encode(array("exito" => false, "mensaje" => "Error: no se envió el formulario de inicio de sesión"));
}

$conn->close();
?>
