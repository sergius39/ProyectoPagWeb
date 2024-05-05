<?php
session_start();
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? ucfirst($_SESSION['nombreUsuario']) : null;
$apellidoUsuario= isset($_SESSION['apellidoUsuario']) ? $_SESSION['apellidoUsuario'] : null;
$email= isset($_SESSION['emailUsuario']) ? $_SESSION['emailUsuario'] : null;
$telefonoUsuario = isset($_SESSION['telefonoUsuario']) ? $_SESSION['telefonoUsuario'] : null;
$password = isset($_SESSION['passUsuario']) ? $_SESSION['passUsuario'] : null;

function enmascararContraseña() {
    return "*****";
}

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

            <nav class="navbar">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>             
                </ul>
            </nav>

            <?php if (!$nombreUsuario): ?> <!-- Verificar si no hay una sesión abierta -->
            <nav class="iconos-carritoLogin login-responsive carro">                
                <ul>
                    <li>                                          
                        <img  src="imagenes/login.svg" width=22px onclick="openModal()">                        
                    </li>
                </ul>
            
                <?php endif; ?> <!-- Fin de la verificación de la sesión -->
            </nav>

            <nav class="carrito-responsive carro">
                <ul>
                    <li>
                    <img id="openCartBtn" src="imagenes/cart.svg" alt="Carrito de compras">
                    </li>
                </ul>
            </nav>

            <nav class="navbar sesion_login usuario_responsive">  
                <?php
                    if ($nombreUsuario){
                        echo '<a href="informacion_perfil.php">¡Hola, ' . $nombreUsuario . '!</a>'; 
                    }   
                    ?>          
            </nav>            
        </div>         
    </header>
    
    <section class="products container" id="lista-1">
        <h3 class="platos-semana cerrar_sesion"> Mis datos     
                <?php 
                    if ($nombreUsuario) { 
                        echo'<a href="destruir_sesion.php"><img  src="imagenes/cross.svg" width=10px height=10px> Cerrar sesión</a>';                
                    }
                ?>      
        </h3>
    <hr>

    <div class="perfil">    

        <div class="datos">
    
            <div class="input_field">
                <i class="fa-solid fa-user"></i>
                <?php
            if ($nombreUsuario){
                echo $nombreUsuario. " ". $apellidoUsuario;              
            }   
        ?>
                                
            </div>
                    
            <div class="input_field">
                <i class="fa-solid fa-envelope"></i>  
                <?php
                    if ($email){
                        echo $email;              
                    }   
                ?>                            
            </div>
                    
            <div class="input_field">                    
                <i class="fa-solid fa-phone"></i>   
                <?php
                    if ($telefonoUsuario){
                        echo $telefonoUsuario;              
                    }   
                ?>
                                    
            </div>

            <div class="input_field">                    
                <i class="fa-solid fa-key"></i>   
                <?php
                    if ($password){
                        echo enmascararContraseña (); // Mostrar cinco asteriscos en lugar de la contraseña              
                    };                                   
                ?>
                                    
            </div>

            <h3 class="platos-semana"> Mis Pedidos</h3>
            <hr>        
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