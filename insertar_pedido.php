<?php

session_start();
include('conexion.php');
$idcliente = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;


if (!isset($_SESSION['idUsuario'])) {
    $_SESSION['error_message'] = "Para procesar tu pedido es necesario registrarse";
    header("Location: checkout.php"); // Redirigir de vuelta a checkout.php
    exit; // Detener la ejecución del script
}

// Decodificar los datos del carrito y el total
$cartData = json_decode($_GET['cartData'], true);
$total = $_GET['total']. " €";

// Preparar la consulta SQL para insertar el pedido
$sql_pedido = "INSERT INTO pedido (idcliente, totalPedido, fechaPedido) VALUES (?, ?, NOW())";
$stmt_pedido = $conn->prepare($sql_pedido);

if ($stmt_pedido) {
    // Vincular los parámetros
    $stmt_pedido->bind_param("is", $idcliente,$total);

    // Ejecutar la consulta preparada para insertar el pedido
    if ($stmt_pedido->execute()) {
        // Obtener el ID del pedido insertado
        $id_pedido = $stmt_pedido->insert_id;

        // Variable para controlar si se insertaron los detalles del pedido correctamente
        $detalles_insertados = true;

        // Insertar los detalles del pedido en la tabla `detalle_pedido`
        foreach ($cartData as $item) {
            if (isset($item['id']) && isset($item['quantity'])) {
                // Extraer el tipo y el número del ID del producto
                $id_parts = explode('-', $item['id']);
                // Verificar si la división fue exitosa y tiene al menos dos partes
                if (count($id_parts) >= 2) {
                    $tipo_item = $id_parts[0]; // Tipo de producto
                    $id_producto = $id_parts[1]; // ID del producto
                    $cantidad = $item['quantity']; // Cantidad del producto

                    echo "<script>";
                    echo "console.log('Tipo de Producto:', '" . json_encode($tipo_item) . "');";
                    echo "console.log('ID del Producto:', '" . json_encode($id_producto) . "');";
                    echo "console.log('Cantidad:', '" . json_encode($cantidad) . "');";
                    echo "</script>";


                } else {
                    echo "Error: El formato de ID del producto es incorrecto";
                }
            } else {
                echo "Error: Faltan claves 'id' o 'quantity' en el ítem del carrito";
            }

            // Preparar la consulta SQL para insertar el detalle del pedido
            $sql_detalle_pedido = "INSERT INTO detalle_pedido (id_pedido, id_producto, tipo_item, cantidad) VALUES (?, ?, ?, ?)";
            $stmt_detalle_pedido = $conn->prepare($sql_detalle_pedido);
            $stmt_detalle_pedido->bind_param("iisi", $id_pedido, $id_producto, $tipo_item, $cantidad);

            // Ejecutar la consulta preparada para insertar el detalle del pedido
            if (!$stmt_detalle_pedido->execute()) {
                // Si falla la inserción de algún detalle, establecer la variable a false
                $detalles_insertados = false;
                break; // Salir del bucle
            }
            
            $stmt_detalle_pedido->close();
        }

        // Si todos los detalles se insertaron correctamente
        if ($detalles_insertados) {
            // Mostrar mensaje de éxito
            echo "Pedido insertado correctamente.";
        } else {
            // Si falla la inserción de algún detalle, eliminar el pedido previamente insertado
            $sql_eliminar_pedido = "DELETE FROM pedido WHERE idpedido = ?";
            $stmt_eliminar_pedido = $conn->prepare($sql_eliminar_pedido);
            $stmt_eliminar_pedido->bind_param("i", $id_pedido);
            $stmt_eliminar_pedido->execute();
            $stmt_eliminar_pedido->close();

            echo "Error al insertar los detalles del pedido.";
        }
    } else {
        echo "Error al insertar el pedido: " . $stmt_pedido->error;
    }

    // Cerrar la declaración preparada para insertar el pedido
    $stmt_pedido->close();
} else {
    echo "Error al preparar la consulta para insertar el pedido: " . $conn->error;
}

// Cerrar la conexión
$conn->close();


?>
