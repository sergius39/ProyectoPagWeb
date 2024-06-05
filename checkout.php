<?php
session_start();
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? ucfirst($_SESSION['nombreUsuario']) : null;
$idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;

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
        <a href="index.php" class="logo"><span>Fresh</span>Taste</a>
      </div>

      <div class=menu-opciones>
        <nav class="navbar">
          <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
          </ul>
        </nav>
      </div>

      <div class="contenedor-carrito-login">

        <nav>
          <ul>
            <li>
              <img id="openCartBtn" src="imagenes/cart.svg" alt="Carrito de compras" onclick="openCartModal()">
            </li>
          </ul>
        </nav>

        <?php if (!$nombreUsuario) : ?> <!-- Verificar si no hay una sesión abierta -->
          <nav class="icono-login">
            <ul>
              <li>
                <img src="imagenes/login.svg" width=22px onclick="openModal()">
              </li>
            </ul>
          <?php endif; ?> <!-- Fin de la verificación de la sesión -->
          </nav>

          <nav class="sesion_login">
            <?php
            if ($nombreUsuario) {
              echo '<a href="informacion_perfil.php">¡Hola, ' . $nombreUsuario . '!</a>';
            }
            ?>
          </nav>
      </div>
    </div>
  </header>

  <section class="products container" id="lista-1">
    <h3 class="platos-semana">
      <?php
      if ($nombreUsuario == null) {
        echo "Este es tu pedido";
      } else {
        echo "Pedido de " . $nombreUsuario;
      }
      ?>
    </h3>
    <hr>
    <div class="datos perfil total_resumen" >
      <div id="checkoutItems"></div>
      <div class="errores_pedido"><?php if (isset($_SESSION['error_message'])) { echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
          unset($_SESSION['error_message']);}?>
      </div>
      
      <p id="total" class="perfil">Total: $0.00</p>
      <button id="processPurchaseBtn" class="perfil">Procesar Compra</button>
      <script src="checkout.js"></script>
    </div>

  </section>

  <footer class="footer">

<div class="footer-copyright">

  <div class="fresh">
    <h3><span>Fresh</span>Taste</h3>
  </div>

  <div class="copyright-responsive">
    <i class="fa-sharp fa-regular fa-copyright"></i>
  </div>
</div>

<div class="footer-copyright">
  <div class="link producto">
    <a href="productos.php">Productos</a>
  </div>

  <div class="link">
    <a href="politica.php">Política de Privacidad</a>
  </div>

  <div class="link">
    <a href="condiciones.php">Términos y Condiciones</a>
  </div>

  <div class="link">
    <a href="aviso_legal.php">Aviso Legal</a>
  </div>

  <div class="link">
    <a href="contacto.php">info@freshtaste.com</a>
  </div>
</div>

<div class="redes-sociales">
  <div>
    <a href="https://www.instagram.com" class="instagram"><i class="fa-brands fa-instagram"></i></a>
  </div>

  <div>
    <a href="https://www.facebook.com" class="facebook"><i class="fa-brands fa-facebook"></i></a>
  </div>

  <div>
    <a href="https://www.twitter.com" class="twitter"><i class="fa-brands fa-twitter"></i></a>
  </div>
</div>

<div>
  <p>© 2024 Todos los derechos reservados</p>
</div>

</footer>

<!-- Modal Inicio de sesión-->
<div id="ModalLogin" class="modal">
<div class="modal-content">
  <span class="close" onclick="closeModal()">&times;</span>
  <h2><span>Fresh</span>Taste</h2>
  <div id="error" class="errores"></div>
  <form id="loginForm" method="post" action="">
    <input type="text" placeholder="Email" id="email" name="email" class="modal-txt">
    <input type="password" placeholder="Contraseña" id="password" name="password" class="modal-txt">
    <input type="submit" name="validar" value="Entrar" onclick="return login()">
    <p>¿Aún no tienes cuenta?<a href="registro.php"> Regístrate</a></p>
  </form>
</div>
</div>

<!-- Modal del carrito de compras -->
<div id="cartModal" class="cart-modal">
<div class="cart-modal-content">
  <span class="close-cart-modal" onclick="closeCartModal()">&times;</span>
  <h2><span>Fresh</span>Taste</h2>
  <div id="cartItems"></div>
  <p id="total">Total: $0</p>
  <p id="emptyCartMessage" style="display: none;">Tu carrito está vacío</p>
  <button id="summaryBtn">Resumen de Compra</button>
</div>
</div>

<script src="script.js"></script>
</body>

</html>