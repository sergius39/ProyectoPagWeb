<?php
include 'conexion.php';


//BOTÓN CONSULTAR

// Verificar si se ha enviado el formulario y si se ha presionado el botón de "Consultar" en la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'Consultar usuario') {
  // Obtener los valores de los campos del formulario
  $idCliente = $_POST['idCliente-admin'] ?? '';
  $usuario = $_POST['usuario-admin'] ?? '';
  $apellido = $_POST['apellido-admin'] ?? '';
  $email = $_POST['email-admin'] ?? '';
  $telefono = $_POST['telefono-admin'] ?? '';

  // Array para almacenar las consultas y sus resultados
  $consultas = [];

  // Consulta general si no se ingresó ningún dato
  if (empty($usuario) && empty($apellido) && empty($email) && empty($telefono) && empty($idCliente)) {
    $consulta_general = "SELECT * FROM usuarios";
    $resultado_general = $conn->query($consulta_general);
    $consultas['Todos los usuarios'] = $resultado_general->fetch_all(MYSQLI_ASSOC);
  }

  // Consultar si se ha ingresado un valor en el campo de id
  if (!empty($idCliente)) {
    $consulta_idCliente = "SELECT * FROM usuarios WHERE idcliente = ?";
    $stmt_idCliente = $conn->prepare($consulta_idCliente);
    $stmt_idCliente->bind_param("i", $idCliente);
    $stmt_idCliente->execute();
    $resultado_idCliente = $stmt_idCliente->get_result();
    $consultas['Usuario por id'] = $resultado_idCliente->fetch_all(MYSQLI_ASSOC);
    $stmt_idCliente->close();
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

// BOTÓN ACTUALIZAR

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'Actualizar usuario') {
  $idCliente = $_POST['idCliente-admin'] ?? '';

  // Verificar si se ha ingresado el ID del cliente
  if (empty($idCliente)) {
    echo "Debe ingresar el ID del cliente para actualizar.";
  } else {
    // Obtener los valores de los otros campos del formulario
    $usuario = $_POST['usuario-admin'] ?? '';
    $apellido = $_POST['apellido-admin'] ?? '';
    $email = $_POST['email-admin'] ?? '';
    $telefono = $_POST['telefono-admin'] ?? '';

    // Verificar si al menos uno de los campos ha sido ingresado
    if (empty($usuario) && empty($apellido) && empty($email) && empty($telefono)) {
      echo "Debe ingresar al menos un valor para actualizar.";
    } else {
      // Crear la consulta preparada
      $consulta_actualizar = "UPDATE usuarios SET";

      $parametros = []; // Array para almacenar los valores de los parámetros
      $tipos = ''; // String para almacenar los tipos de datos de los parámetros

      // Verificar qué campos se han ingresado y agregarlos a la consulta preparada
      if (!empty($usuario)) {
        $consulta_actualizar .= " nombre = ?,";
        $parametros[] = &$usuario;
        $tipos .= 's';
      }
      if (!empty($apellido)) {
        $consulta_actualizar .= " apellido = ?,";
        $parametros[] = &$apellido;
        $tipos .= 's';
      }
      if (!empty($email)) {
        $consulta_actualizar .= " email = ?,";
        $parametros[] = &$email;
        $tipos .= 's';
      }
      if (!empty($telefono)) {
        $consulta_actualizar .= " telefono = ?,";
        $parametros[] = &$telefono;
        $tipos .= 's';
      }

      // Eliminar la coma extra al final de la consulta
      $consulta_actualizar = rtrim($consulta_actualizar, ",");

      // Agregar la condición WHERE
      $consulta_actualizar .= " WHERE idcliente = ?";

      // Agregar el tipo de dato para el ID del cliente
      $tipos .= 'i';
      $parametros[] = &$idCliente;

      // Ejecutar la consulta preparada
      $stmt = $conn->prepare($consulta_actualizar);
      if ($stmt) {
        // Unir los parámetros con sus tipos
        $params = array_merge([$tipos], $parametros);

        // Llamar a bind_param con los parámetros por referencia
        call_user_func_array(array($stmt, 'bind_param'), $params);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se actualizaron filas
        if ($stmt->affected_rows > 0) {
          echo "Los datos se actualizaron correctamente.";
        } else {
          echo "No se realizaron cambios.";
        }

        // Cerrar la consulta preparada
        $stmt->close();
      } else {
        echo "Error al preparar la consulta: " . $conn->error;
      }
    }
  }
}

//BOTÓN BORRAR USUARIO

// Verificar si se ha enviado el formulario y si se ha presionado el botón de "Borrar Usuario" en la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'Borrar usuario') {

  $idCliente = $_POST['idCliente-admin'] ?? '';
  $usuario = $_POST['usuario-admin'] ?? '';
  $apellido = $_POST['apellido-admin'] ?? '';
  $email = $_POST['email-admin'] ?? '';
  $telefono = $_POST['telefono-admin'] ?? '';

  // Verificar si se ha ingresado el ID del cliente
  if (empty($usuario) && empty($apellido) && empty($email) && empty($telefono) && empty($idCliente)) {
    echo "Debe ingresar al menos un valor para borrar.";
  } else {

    // idCliente
    if (!empty($idCliente)) {
      $consulta_borrar_idCliente = "DELETE FROM usuarios WHERE idcliente = ?";
      $stmt_idCliente = $conn->prepare($consulta_borrar_idCliente);
      $stmt_idCliente->bind_param("i", $idCliente);
      $stmt_idCliente->execute();

      if ($stmt_idCliente->affected_rows > 0) {
        echo "Borrado de usuario realizado con éxito";
      } else {
        echo "No se encontró ningún usuario con el ID proporcionado.";
      }
      $stmt_idCliente->close();
    }

    // Usuario
    if (!empty($usuario)) {
      $consulta_borrar_usuario = "DELETE FROM usuarios WHERE nombre = ?";
      $stmt_usuario = $conn->prepare($consulta_borrar_usuario);
      $stmt_usuario->bind_param("s", $usuario);
      $stmt_usuario->execute();

      if ($stmt_usuario->affected_rows > 0) {
        echo "Borrado de usuario realizado con éxito";
      } else {
        echo "No se encontró ningún usuario con el nombre proporcionado.";
      }
      $stmt_usuario->close();
    }

    // Apellido
    if (!empty($apellido)) {
      $consulta_borrar_apellido = "DELETE FROM usuarios WHERE apellido = ?";
      $stmt_apellido = $conn->prepare($consulta_borrar_apellido);
      $stmt_apellido->bind_param("s", $apellido);
      $stmt_apellido->execute();

      if ($stmt_apellido->affected_rows > 0) {
        echo "Borrado de usuario realizado con éxito";
      } else {
        echo "No se encontró ningún usuario con el apellido proporcionado.";
      }
      $stmt_apellido->close();
    }

    // Email
    if (!empty($email)) {
      $consulta_borrar_email = "DELETE FROM usuarios WHERE email = ?";
      $stmt_email = $conn->prepare($consulta_borrar_email);
      $stmt_email->bind_param("s", $email);
      $stmt_email->execute();

      if ($stmt_email->affected_rows > 0) {
        echo "Borrado de usuario realizado con éxito";
      } else {
        echo "No se encontró ningún usuario con el email proporcionado.";
      }
      $stmt_email->close();
    }

    // Teléfono
    if (!empty($telefono)) {
      $consulta_borrar_telefono = "DELETE FROM usuarios WHERE telefono = ?";
      $stmt_telefono = $conn->prepare($consulta_borrar_telefono);
      $stmt_telefono->bind_param("i", $telefono);
      $stmt_telefono->execute();

      if ($stmt_telefono->affected_rows > 0) {
        echo "Borrado de usuario realizado con éxito";
      } else {
        echo "No se encontró ningún usuario con el telefono proporcionado.";
      }
      $stmt_telefono->close();
    }
  }
}

// TABLA PLATOS CONSULTAR

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'Consultar plato') {
  $idPlato = $_POST['idPlato-admin'];
  $nombrePlato = $_POST['nombrePlato-admin'];
  $descripcionPlato = $_POST['descripcionPlato-admin'];
  $precioPlato = $_POST['precioPlato-admin'];
  $tablas = $_POST['tabla'];

  if (empty($tablas)) {
    echo "Es necesario elegir una tabla.";
  } else {

    switch ($tablas) {
      case 'cremas':
        $campo_id = 'idcrema';
        break;
      case 'pizzas':
        $campo_id = 'idpizza';
        break;
      case 'platos':
        $campo_id = 'idplato';
        break;
      case 'ensaladas':
        $campo_id = 'idensalada';
        break;
      case 'postres':
        $campo_id = 'idpostre';
          break;
      default:
          echo "Tabla no reconocida.";
          return;
    }

    $consultas = [];

    if (empty($idPlato) && empty($nombrePlato) && empty($descripcionPlato) && empty($precioPlato)) {
      $consulta_general = "SELECT * FROM $tablas";
      $resultado_general = $conn->query($consulta_general);
      $consultas['Resultado'] = $resultado_general->fetch_all(MYSQLI_ASSOC);
    }

    // Consultar si se ha ingresado un valor en el campo de id
    if (!empty($idPlato)) {
      $consulta_idPlato = "SELECT * FROM $tablas WHERE $campo_id = ?";
      $stmt_idPlato = $conn->prepare($consulta_idPlato);
      $stmt_idPlato->bind_param("i", $idPlato);
      $stmt_idPlato->execute();
      $resultado_idPlato = $stmt_idPlato->get_result();
      $consultas['Resultados por id'] = $resultado_idPlato->fetch_all(MYSQLI_ASSOC);
      $stmt_idPlato->close();
    }


    // Consultar si se ha ingresado un valor en el campo de usuario
    if (!empty($nombrePlato)) {
      $consulta_nombrePlato = "SELECT * FROM $tablas WHERE nombre = ?";
      $stmt_nombrePlato = $conn->prepare($consulta_nombrePlato);
      $stmt_nombrePlato->bind_param("s", $nombrePlato);
      $stmt_nombrePlato->execute();
      $resultado_nombrePlato = $stmt_nombrePlato->get_result();
      $consultas['Resultados por nombre'] = $resultado_nombrePlato->fetch_all(MYSQLI_ASSOC);
      $stmt_nombrePlato->close();
    }

    // Consultar si se ha ingresado un valor en el campo de apellido
    if (!empty($descripcionPlato)) {
      $consulta_descripcionPlato = "SELECT * FROM $tablas WHERE descripcion = ?";
      $stmt_descripcionPlato = $conn->prepare($consulta_descripcionPlato);
      $stmt_descripcionPlato->bind_param("s", $descripcionPlato);
      $stmt_descripcionPlato->execute();
      $resultado_descripcionPlato = $stmt_descripcionPlato->get_result();
      $consultas['Resultados por descripcion'] = $resultado_descripcionPlato->fetch_all(MYSQLI_ASSOC);
      $stmt_descripcionPlato->close();
    }

    // Consultar si se ha ingresado un valor en el campo de email
    if (!empty($precioPlato)) {
      $consulta_precioPlato = "SELECT * FROM $tablas WHERE precio = ?";
      $stmt_precioPlato = $conn->prepare($consulta_precioPlato);
      $stmt_precioPlato->bind_param("s", $precioPlato);
      $stmt_precioPlato->execute();
      $resultado_precioPlato = $stmt_precioPlato->get_result();
      $consultas['Resultados por precio'] = $resultado_precioPlato->fetch_all(MYSQLI_ASSOC);
      $stmt_precioPlato->close();
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
}
