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

      <?php if (!$nombreUsuario): ?> <!-- Verificar si no hay una sesión abierta -->
      <nav class="icono-login">                
        <ul>
         <li>                                          
           <img  src="imagenes/login.svg" width=22px onclick="openModal()">                        
          </li>
        </ul>            
      <?php endif; ?> <!-- Fin de la verificación de la sesión -->  
      </nav> 

      <nav class="sesion_login">  
        <?php
          if ($nombreUsuario){
            echo '<a href="informacion_perfil.php">¡Hola, ' . $nombreUsuario . '!</a>'; 
          }   
        ?>          
      </nav>  
    </div>     
  </div>         
</header>

<section class="products container" id="lista-1">
    <h3 class="platos-semana">Platos de la semana</h3>
    <p class="descripcion-plato-semana">Aqui tienes una selección de nuestros platos con más éxito</p>
    <hr>

    <div class="products-content">

       <!-- Productos -->
       <div class="product" data-id="pizza-1" data-name="Pizza de salvia y champiñón" data-price="12.50">
        <!-- Contenido del producto -->
        <img src="imagenes/pizzas-saudables-champinon.jpg" alt="">
        <h3>Pizza de salvia y champiñón</h3>
        <p>Impresionante pizza de champiñones acompañada por el toque fresco de la salvia</p>
        <p class="precio ">12.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="pizza-2" data-name="Pizza de champiñones y aceitunas" data-price="12.50">
        <img src="imagenes/pizatortilla.jpg" alt="">
        <h3>Pizza de champiñones y aceitunas</h3>
        <p>Prueba nuestra pizza con base de tortilla, te sorprenderá</p>
        <p class="precio">12.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="pizza-3" data-name="Pizza de espárragos y calabacín" data-price="11.00">
        <img src="imagenes/pizzaesparrago.jpg" alt="">
        <h3>Pizza de espárragos y calabacín</h3>
        <p>Deliciosa pizza de espárragos con calabacín que te hará la boca agua</p>
        <p class="precio">11.00 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="pizza-4" data-name="Pizza de tomatitos y albahaca" data-price="13.50">
        <img src="imagenes/pizza-caliente.webp" alt="">
        <h3>Pizza de tomatitos y albahaca</h3>
        <p>Espectacular pizza de tomate con el toque fresco de la albahaca</p>
        <p class="precio">13.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="ensalada-1" data-name="Ensalada de Pollo" data-price="7.50">
        <img src="imagenes/pollo con guarnición.jpg" alt="">
        <h3>Ensalada de Pollo</h3>
        <p>Prueba nuestra impresionante ensalada de pollo con mango y aguacate</p>
        <p class="precio">7.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="ensalada-2" data-name="Ensalada griega" data-price="7.50">
        <img src="imagenes/ensalada griega.jpg" alt="">
        <h3>Ensalada griega</h3>
        <p>Traemos el sabor griego a tu mesa</p>
        <p class="precio ajuste-txt">7.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="ensalada-3" data-name="Ensalada César" data-price="9.00">
        <img src="imagenes/ensaladacesar.jpg" alt="">
        <h3>Ensalada César</h3>
        <p>No podía faltar la famosísima ensalada César</p>
        <p class="precio ajuste-txt">9.00 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="ensalada-4" data-name="Ensalada niçoise" data-price="7.50">
        <img src="imagenes/ensaladanicoise.jpg" alt="">
        <h3>Ensalada niçoise</h3>
        <p>Desconocida pero no por ello, espectacular ensalada que viene de Francia</p>
        <p class="precio">7.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>

    <div class="product" data-id="postre-1" data-name="Crema de papaya con helado y frutos rojos" data-price="3.50">
        <img src="imagenes/crema-de-papaya-con-helado-y-frutos-rojos.jpg" alt="">
        <h3>Crema de papaya con helado y frutos rojos</h3>
        <p>Fresca y suave crema de helado con papaya y un toque de frutos rojos</p>
        <p class="precio">3.50 €</p>
        <button class="agregar-carrito btn-2">Agregar al carrito</button>
    </div>
    </div>
  </section>






















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

<!-- Modal carrito de la compra-->
<div id="cartModal" class="modalCarrito">
  <div class="modal-contentCarrito">
    <span class="closeCarrito">&times;</span>
    <h2><span>Fresh</span>Taste</h2>
    <!-- Contenido del carrito -->
    <p>Tu carrito está vacío.</p>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>