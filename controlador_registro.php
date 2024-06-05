<?php
include('conexion.php');
$errorVacio = false;
$errorPass = false;
$errorNombre = false;
$errorEmail = false;
$errorTelefono = false;
$errorDireccion = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["nombreRegistro"]) || empty($_POST["apellidoRegistro"]) || empty($_POST["emailRegistro"]) || empty($_POST["direccionRegistro"]) || empty($_POST["pass1Registro"]) || empty($_POST["pass2Registro"])) {

    echo "<p>Oopss, parece que falta algún dato!</p>";
    $errorVacio = true;
  } else {

    if (!preg_match("/^[A-Za-z ]{1,50}$/", $_POST["nombreRegistro"]) || !preg_match("/^[A-Za-z ]{1,50}$/", $_POST["apellidoRegistro"])) {
      echo "<p>Recuerda que los nombres y los apellidos solo pueden tener letras</p>";
      $errorNombre = true;
    }

    if (!preg_match("/^[6-9][0-9]{8}+$/", $_POST["telefonoRegistro"])) {
      echo "<p>El teléfono no es válido en España</p>";
      $errorTelefono = true;
    }

    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST["direccionRegistro"])) {
      echo "<p>La dirección no es válida, solo números y letras</p>";
      $errorDireccion = true;
    }

    $correo = $_POST["emailRegistro"];

    // Consulta SQL sentencias preparadas
    $sql = "SELECT email FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo); // "s" indica que el parámetro es de tipo string

    // Ejecutar la consulta
    $stmt->execute();

    // Almacenar el resultado de la consulta
    $stmt->store_result();

    // Verificar si se encontró un correo electrónico
    if ($stmt->num_rows > 0) {
      // Si hay al menos una fila, significa que el correo electrónico ya existe
      echo "<p>El correo no es válido, ya se encuentra en nuestra base de datos</p>";
      $errorEmail = true;
    }

    // Cerrar la sentencia
    $stmt->close();

    if ($_POST["pass1Registro"] == $_POST["pass2Registro"]) {
    } else {
      echo "<p>Asegurate bien de que las contraseñas sean iguales</p>";
      $errorPass = true;
    }
  }

  if (!$errorVacio && !$errorNombre && !$errorPass && !$errorTelefono && !$errorEmail && !$errorDireccion) {

    $_SESSION['nombre'] = $_POST["nombreRegistro"];
    $_SESSION['apellido'] = $_POST["apellidoRegistro"];
    $_SESSION['telefono'] = $_POST["telefonoRegistro"];
    $_SESSION['email'] = $_POST["emailRegistro"];
    $_SESSION['password'] = $_POST["pass1Registro"];
    $_SESSION['direccion'] = $_POST["direccionRegistro"];

    header("Location: inserciondatos.php");
  }
}
