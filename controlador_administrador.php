<?php
include 'conexion.php';

// Verificar si se ha enviado el formulario y si se ha presionado el botón de "Consultar" en la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'Consultar') {
    // Obtener los valores de los campos del formulario
    $usuario = $_POST['usuario-admin'] ?? '';
    $apellido = $_POST['apellido-admin'] ?? '';
    $email = $_POST['email-admin'] ?? '';
    $telefono = $_POST['telefono-admin'] ?? '';

    // Array para almacenar las consultas y sus resultados
    $consultas = [];

    // Consulta general si no se ingresó ningún dato
    if (empty($usuario) && empty($apellido) && empty($email) && empty($telefono)) {
        $consulta_general = "SELECT * FROM usuarios";
        $resultado_general = $conn->query($consulta_general);
        $consultas['Todos los usuarios'] = $resultado_general->fetch_all(MYSQLI_ASSOC);
    }

    // Consultar si se ha ingresado un valor en el campo de usuario
    if (!empty($usuario)) {
        $consulta_usuario = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt_usuario = $conn->prepare($consulta_usuario);
        $stmt_usuario->bind_param("s", $usuario);
        $stmt_usuario->execute();
        $resultado_usuario = $stmt_usuario->get_result();
        $consultas['Usuarios por nombre'] = $resultado_usuario->fetch_all(MYSQLI_ASSOC);
        $stmt_usuario->close();
    }

    // Consultar si se ha ingresado un valor en el campo de apellido
    if (!empty($apellido)) {
        $consulta_apellido = "SELECT * FROM usuarios WHERE apellido = ?";
        $stmt_apellido = $conn->prepare($consulta_apellido);
        $stmt_apellido->bind_param("s", $apellido);
        $stmt_apellido->execute();
        $resultado_apellido = $stmt_apellido->get_result();
        $consultas['Usuarios por apellido'] = $resultado_apellido->fetch_all(MYSQLI_ASSOC);
        $stmt_apellido->close();
    }

    // Consultar si se ha ingresado un valor en el campo de email
    if (!empty($email)) {
        $consulta_email = "SELECT * FROM usuarios WHERE email = ?";
        $stmt_email = $conn->prepare($consulta_email);
        $stmt_email->bind_param("s", $email);
        $stmt_email->execute();
        $resultado_email = $stmt_email->get_result();
        $consultas['Usuarios por email'] = $resultado_email->fetch_all(MYSQLI_ASSOC);
        $stmt_email->close();
    }

    // Consultar si se ha ingresado un valor en el campo de teléfono
    if (!empty($telefono)) {
        $consulta_telefono = "SELECT * FROM usuarios WHERE telefono = ?";
        $stmt_telefono = $conn->prepare($consulta_telefono);
        $stmt_telefono->bind_param("i", $telefono);
        $stmt_telefono->execute();
        $resultado_telefono = $stmt_telefono->get_result();
        $consultas['Usuarios por teléfono'] = $resultado_telefono->fetch_all(MYSQLI_ASSOC);
        $stmt_telefono->close();
    }

    // Mostrar los resultados
    foreach ($consultas as $titulo => $resultado) {
        echo "<div class='resultado'>";
        echo "<h4>$titulo</h4>";
        if (!empty($resultado)) {
            foreach ($resultado as $fila) {
                foreach ($fila as $clave => $valor) {
                    echo "$clave: $valor<br>";
                }
                echo "<hr>";
            }
        } else {
            echo "No se encontraron resultados.";
        }
        echo "</div>";
    }
}
?>
