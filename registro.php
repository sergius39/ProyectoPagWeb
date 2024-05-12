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
 
<section class="products container">

<h3 class="titulo-comentario">Registro</h3>
<hr>
    <div>

    <form action="" method="POST" class="formulario-login">

        <div class="input_group">

            <div>
            <h1><span>Fresh</span>Taste</h1>
            </div>      

            <div class=errores>
                <?php                       
                include ('controlador_registro.php');                  
                ?>
            </div>

            <div class="input_field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nombreRegistro" id="idnombre" placeholder="Nombre" value="<?php if(isset($_POST["nombreRegistro"])) echo $_POST["nombreRegistro"];?>"> 
            </div>
    
            <div class="input_field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="apellidoRegistro" id="idemail" placeholder="Apellido" value="<?php if(isset($_POST["apellidoRegistro"])) echo $_POST["apellidoRegistro"];?>">                  
            </div>

            <div class="input_field">
                <i class="fa-solid fa-phone"></i>
                <input type="text" name="telefonoRegistro" id="idtelefono" placeholder="Teléfono" value="<?php if(isset($_POST["telefonoRegistro"])) echo $_POST["telefonoRegistro"];?>">                  
            </div>
    
            <div class="input_field">
                <i class="fa-solid fa-envelope"></i>  
                <input type="email" name="emailRegistro" id="idtel" placeholder="Correo Electrónico" value="<?php if(isset($_POST["emailRegistro"])) echo $_POST["emailRegistro"];?>">                     
            </div>

            <div class="input_field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="pass1Registro" id= "idpass1" placeholder="Contraseña"value="<?php if(isset($_POST["pass1Registro"])) echo $_POST["pass1Registro"];?>">    
            </div>

            <div class="input_field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="pass2Registro" id= "idpass2" placeholder="Repetir Contraseña" value="<?php if(isset($_POST["pass2Registro"])) echo $_POST["pass2Registro"];?>">     
            </div>

            <div class="enviar_registro input_field">
                <input type="submit" id="idenviar" value="Enviar">
            </div>
        </div>

    </form>

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