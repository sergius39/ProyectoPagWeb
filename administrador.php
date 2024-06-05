<?php
session_start();
$administrador =  $_SESSION['administrador'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="header">
    <div class="menu container">
      <div>

        <a href="#" class="logo"><span>Fresh</span>Taste</a>
      </div>
    </div>
  </header>

  <section class="products container" id="lista-1">
    <h3 class="platos-semana"> Administrador
      <?php
      if ($administrador) {
        echo '<a href="destruir_sesion.php" class="cerrar_sesion_admin">Cerrar sesión</a>';
      }
      ?>
    </h3>
    <hr>

    <div class="admin-container">

      <div class="row-container">

        <form class="admin-form" method="POST">
          <h4>Clientes</h4>
          <hr>

          <div class="admin-input">
            Id Cliente <input type="text" name='idCliente-admin'>
          </div>

          <div class="admin-input">
            Usuario <input type="text" name='usuario-admin'>
          </div>

          <div class="admin-input">
            Apellido <input type="text" name='apellido-admin'>
          </div>

          <div class="admin-input">
            Correo <input type="text" name='email-admin'>
          </div>
       

          <div class="admin-input">
            Teléfono <input type="text" name='telefono-admin'>
          </div>

          <div class="btn-admin">
            <input type="submit" name="accion" value="Consultar usuario">
            <input type="submit" name="accion" value="Actualizar usuario">
            <input type="submit" name="accion" value="Borrar usuario">

          </div>
        </form>

        <form class="admin-form tabla-responsive" method="POST">
          <h4>Platos</h4>
          <hr>
          <div class="admin-input">
            Id Plato <input type="text" name='idPlato-admin'>
          </div>

          <div class="admin-input">
            Nombre <input type="text" name='nombrePlato-admin'>
          </div>

          <div class="admin-input">
            Descripción <input type="text" name='descripcionPlato-admin'>
          </div>

          <div class="admin-input">
            Precio <input type="text" name='precioPlato-admin'>
          </div>

          <div class="admin-input" name='tablas-admin'>
            Tablas
            <select name="tabla">
              <option value=""></option>
              <option value="platos">Platos</option>
              <option value="cremas">Cremas</option>
              <option value="ensaladas">Ensaladas</option>
              <option value="pizzas">Pizzas</option>
              <option value="postres">Postres</option>
            </select>
          </div>

          <div class="btn-admin">
            <input type="submit" name="accion" value="Consultar plato">
            <input type="submit" name="accion" value="Actualizar plato">
            <input type="submit" name="accion" value="Añadir plato">
            <input type="submit" name="accion" value="Borrar plato">

          </div>
        </form>
      </div>

      <div class="resultado">

        <?php
        include('controlador_administrador.php');
        ?>

      </div>
    </div>
  </section>