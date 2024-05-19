<?php
include 'conexion.php';
$idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;


// Consulta SQL preparada para verificar el último pedido del cliente
$sql_pedido = "SELECT idpedido, fechaPedido FROM pedido WHERE idcliente = ? ORDER BY fechaPedido DESC LIMIT 1";

// Preparar la consulta para verificar el último pedido del cliente
if ($stmt_pedido = $conn->prepare($sql_pedido)) {
  // Vincular parámetro
  $stmt_pedido->bind_param("i", $idUsuario);

  // Ejecutar la consulta
  $stmt_pedido->execute();

  // Obtener el resultado
  $result_pedido = $stmt_pedido->get_result();

  // Comprobar si se obtuvieron filas
  if ($result_pedido->num_rows > 0) {
    // Obtener el último pedido del cliente
    $pedido = $result_pedido->fetch_assoc();

    // Obtener el ID del último pedido
    $idPedido = $pedido['idpedido'];

    // Consulta SQL preparada para obtener detalles del pedido con nombres de productos
    $sql_detalle_pedido = "SELECT dp.id_detalle_pedido, dp.tipo_item, dp.cantidad,
                                      CASE
                                        WHEN dp.tipo_item = 'plato' THEN pl.nombre
                                        WHEN dp.tipo_item = 'ensalada' THEN en.nombre
                                        WHEN dp.tipo_item = 'crema' THEN c.nombre
                                        WHEN dp.tipo_item = 'pizza' THEN pi.nombre
                                        WHEN dp.tipo_item = 'postre' THEN po.nombre
                                      END AS nombre_producto
                               FROM detalle_pedido dp
                               LEFT JOIN platos pl ON dp.tipo_item = 'plato' AND dp.id_producto = pl.idplato
                               LEFT JOIN ensaladas en ON dp.tipo_item = 'ensalada' AND dp.id_producto = en.idensalada
                               LEFT JOIN pizzas pi ON dp.tipo_item = 'pizza' AND dp.id_producto = pi.idpizza
                               LEFT JOIN cremas c ON dp.tipo_item = 'crema' AND dp.id_producto = c.idcrema
                               LEFT JOIN postres po ON dp.tipo_item = 'postre' AND dp.id_producto = po.idpostre

                               WHERE id_pedido = ?";

    // Preparar la consulta para obtener detalles del pedido con nombres de productos
    if ($stmt_detalle_pedido = $conn->prepare($sql_detalle_pedido)) {
      // Vincular parámetro
      $stmt_detalle_pedido->bind_param("i", $idPedido);

      // Ejecutar la consulta
      $stmt_detalle_pedido->execute();

      // Obtener el resultado
      $result_detalle_pedido = $stmt_detalle_pedido->get_result();

      // Comprobar si se obtuvieron filas
      if ($result_detalle_pedido->num_rows > 0) {
        // Imprimir detalles del detalle del pedido
        while ($detalle_pedido = $result_detalle_pedido->fetch_assoc()) {
          echo "<p> <strong>" . $detalle_pedido['cantidad'] . "</strong> " . ucfirst($detalle_pedido['nombre_producto']) . "</p><br>";
        }
      } else {
        echo "No hay detalles del pedido para el ID de pedido " . $idPedido;
      }

      echo "<p>" . $pedido['fechaPedido'] . "</p><br>";


      // Cerrar el resultado del detalle del pedido
      $result_detalle_pedido->close();
      // Cerrar la consulta preparada del detalle del pedido
      $stmt_detalle_pedido->close();
    } else {
      echo "Error al preparar la consulta del detalle del pedido: " . $conn->error;
    }
  } else {
    echo "No se encontraron pedidos";
  }

  // Cerrar el resultado del pedido
  $result_pedido->close();
  // Cerrar la consulta preparada del pedido
  $stmt_pedido->close();
} else {
  echo "Error al preparar la consulta del pedido: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
