<?php

session_start();
include('conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['idUsuario'])) {
    echo json_encode(['success' => false, 'message' => 'Para procesar tu pedido es necesario registrarse']);
    exit;
}

// Obtener ID del cliente
$idcliente = $_SESSION['idUsuario'];

// Obtener los datos enviados desde resumen.js
$data = json_decode(file_get_contents('php://input'), true);
$cartData = $data['cartData'];
$total = $data['total'];

// Preparar la consulta SQL para insertar el pedido
$sql_pedido = "INSERT INTO pedido (idcliente, totalPedido, fechaPedido) VALUES (?, ?, NOW())";
$stmt_pedido = $conn->prepare($sql_pedido);

if ($stmt_pedido) {
    // Vincular los parámetros
    $stmt_pedido->bind_param("is", $idcliente, $total);

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

                } else {
                    echo json_encode(['success' => false, 'message' => 'El formato de ID del producto es incorrecto']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Faltan claves "id" o "quantity" en el ítem del carrito']);
                exit;
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
            echo json_encode(['success' => true, 'message' => 'Pedido insertado correctamente']);
        } else {
            // Si falla la inserción de algún detalle, eliminar el pedido previamente insertado
            $sql_eliminar_pedido = "DELETE FROM pedido WHERE idpedido = ?";
            $stmt_eliminar_pedido = $conn->prepare($sql_eliminar_pedido);
            $stmt_eliminar_pedido->bind_param("i", $id_pedido);
            $stmt_eliminar_pedido->execute();
            $stmt_eliminar_pedido->close();

            echo json_encode(['success' => false, 'message' => 'Error al insertar los detalles del pedido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el pedido: ' . $stmt_pedido->error]);
    }

    // Cerrar la declaración preparada para insertar el pedido
    $stmt_pedido->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta para insertar el pedido: ' . $conn->error]);
}

// Cerrar la conexión
$conn->close();
