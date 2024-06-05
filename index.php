<?php
session_start();
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? ucfirst($_SESSION['nombreUsuario']) : null;
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
  <section class="products container">
    <div class="slogan-content">

      <div class="slogan-txt">
        <h1>Comer bien no cuesta tanto</h1>
      </div>

      <div class="slogan-images">
        <div class="slogan-elegir">
          <img src="imagenes/elige.png" alt="">
          <p>Elige tu comida</p>
        </div>

        <div class="slogan-recibe">
          <img src="imagenes/recibe.png" alt="">
          <p>Recibela</p>
        </div>

        <div class="slogan-disfruta">
          <img src="imagenes/disfruta.png" alt="">
          <p>Disfruta</p>
        </div>
      </div>
      <div class="products">
        <a class="btn-1" href="productos.php">Haz tu pedido aqui!</a>
      </div>
    </div>
  </section>

  <section class="products container" id="lista-1">
    <h3 class="platos-semana">Platos de la semana</h3>
    <p class="descripcion-plato-semana">Aqui tienes una selección de nuestros platos con más éxito</p>
    <hr>

    <div class="products-content">

    <div class="product" data-id="plato-1" data-name="Salmón a la plancha" data-price="7.50">
        <!-- Contenido del producto -->
        <img class="salmon" src="imagenes/salmon a la plancha.jpg" alt="">
        <h3>Salmón a la plancha</h3>
        <p class="ajuste-txt">Delicioso salmón a la plancha acompañado de una cama de verduras</p>
        <p class="precio">7.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

      <div class="product" data-id="plato-7" data-name="Berenjenas rellenas" data-price="8" >        
        <img src="imagenes/berenjenas-rellenas.jpg" alt="">
        <h3>Berenjenas rellenas</h3>
        <p>berenjenas al horno que te dejarán con ganas de más</p>
        <p class="precio">8 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
      </div>

      <div class="product" data-id="crema-1" data-name="Crema de guisantes" data-price="6.50" >         
        <img src="imagenes/crema-de-guisantes.jpg" alt="">
        <h3>Crema de guisantes</h3>
        <p>Deliciosa crema de Guisantes que hará que repitas</p>
        <p class="precio ajuste-txt">6.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
      </div>

      <div class="product" data-id="pizza-1" data-name="Pizza de salvia y champiñón" data-price="12.50" >        
        <img src="imagenes/pizzas-saudables-champinon.jpg" alt="">
        <h3>Pizza de salvia y champiñón</h3>
        <p>Impresionante pizza de champiñones acompañada por el toque fresco de la salvia</p>
        <p class="precio ">12.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
      </div>


      <div class="product" data-id="pizza-4" data-name="Pizza de tomatitos y albahaca" data-price="13.50" >          
        <img src="imagenes/pizza-caliente.webp" alt="">
        <h3>Pizza de tomatitos y albahaca</h3>
        <p>Espectacular pizza de de tomate con el toque fresco de la albahaca</p>
        <p class="precio">13.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
      </div>

      <div class="product" data-id="postre-1" data-name="crema de papaya con helado y frutos rojos.jpg" data-price="3.50" >          
        <img src="imagenes/crema-de-papaya-con-helado-y-frutos-rojos.jpg" alt="">
        <h3>Crema de papaya con helado y frutos rojos</h3>
        <p>Fresca y suave crema de helado con papaya y un toque de frutos rojos</p>
        <p class="precio">3.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
      </div>
    </div>
  </section>

  <section class="services">
    <div class="services-content container">

      <div class="service linea-service">
        <img src="imagenes/abierto.png" alt="">
        <p>Abrimos todos los días de <span>11:00 am a 12:00 pm</span></p>
      </div>

      <div class="service linea-service">
        <img src="imagenes/llamada-telefonica.png" alt="">
        <p>Si deseas ponerte en contacto con nosotros, llámanos al <span>620 52 69 43</span></p>
      </div>

      <div class="service">
        <img src="imagenes/direccion.png" alt="">
        <p>Nos puedes encontrar en <span>C/ San Francisco, 28004, Las Rozas, Madrid</span></p>
      </div>
    </div>

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