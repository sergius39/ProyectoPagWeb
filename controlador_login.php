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

    // Verificar si las credenciales son para el administrador
    if($email == "admin" && $contrasena == "1234"){
        $_SESSION['administrador'] = "Administrador";

        // Si es un administrador, enviar un objeto JSON indicando el tipo de usuario
        echo json_encode(array("exito" => true, "mensaje" => "Inicio de sesión exitoso", "nombreUsuario" => "Administrador", "tipo" => "admin"));

        exit; // Importante para detener la ejecución del script después de enviar la respuesta
    }

    // Consultar la base de datos para obtener la contraseña almacenada
    $sql = "SELECT idcliente, nombre, apellido, telefono, contraseña FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" indica que el parámetro es de tipo string

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular el resultado de la consulta a variables
    $stmt->bind_result($idUsuario, $nombreUsuario, $apellidoUsuario, $telefonoUsuario, $contraseñaAlmacenada);

    // Recuperar el resultado
    $stmt->fetch();

    // Verificar si se encontró un usuario con el correo electrónico correspondiente
    if ($idUsuario) {
        // El usuario existe en la base de datos

        // Verificar si la contraseña proporcionada coincide con la almacenada
        if (password_verify($contrasena, $contraseñaAlmacenada)) {
            // La contraseña es correcta
            $_SESSION['idUsuario'] = $idUsuario;
            $_SESSION['emailUsuario'] = $email;
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['apellidoUsuario'] = $apellidoUsuario;
            $_SESSION['telefonoUsuario'] = $telefonoUsuario; 
            $_SESSION['passUsuario'] = $contrasena;
  

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
