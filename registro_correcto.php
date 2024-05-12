<?php
session_start();
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : null;
?>

<!DOCTYPE html>
<html lang="e2">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    <meta http-equiv="refresh" content="5;url=index.php"> <!-- Redireccionar a index.php después de 5 segundos -->
    <title>Document</title> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            <img id="openCartBtn" src="imagenes/cart.svg" alt="Carrito de compras">
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
        <h3 class="platos-semana">Enhorabuena</h3>
        <hr>
        <p class="descripcion-plato-semana registro">Tu registro se ha completado con éxito. Ya formas parte de la comunidad FreshTaste, pronto podrás disfrutar de nuestros deliciosos platos.</p>         
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
    <div >
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
    <p>© 2024.Todos los derechos reservados</p>
</div>

</footer>
</body>
</html>