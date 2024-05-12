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

        <div class="politica-privacidad">
            <h3 >Información sobre el titular del sitio web</h3>
            <hr>
            <p>
                En cumplimiento de lo previsto en el artículo 10 de la Ley 34/2002 de 11 de julio, de Servicios de la Sociedad de La Información y Comercio Electrónico (LSSICE), se informa al Usuario sobre los datos identificativos del titular del presente sitio web:

                <ul>
                    <li>FRESHTASTE ALIMENTACIÓN, S.L.</li>
                    <li>Dirección Postal: C/ San Francisco, 28004, Las Rozas, Madrid (ESPAÑA).</li>
                    <li>Datos fiscales: NIF: 000000080</li>
                    <li>Contacto: info@freshtaste.com</li>
                </ul>
            </p>                 
        </div>

        <div class="politica-privacidad">
            <h3>Condiciones generales de uso del sitio web</h3>
            <hr>
            <p> 
                El presente Aviso Legal regula el uso permitido de este sitio web, cuyo responsable legal es FRESHTASTE ALIMENTACION, S.L.

                El acceso al sitio web implica la aceptación sin reservas del presente Aviso Legal, por lo que se recomienda la lectura detenida de su contenido. 
                
                El Usuario se compromete a usar la web, sus servicios y contenidos de forma diligente, correcta y lícita y, en particular, se compromete a abstenerse de suprimir, eludir o manipular el copyright y demás contenidos, así como los dispositivos técnicos que se hayan implementado para su protección.
                
                El sitio web y sus servicios son de acceso libre y gratuito. No obstante, FRESHTASTE puede condicionar la utilización de algunos de los servicios ofrecidos en su web a la previa cumplimentación del correspondiente formulario.
                
                El usuario garantiza la autenticidad y actualidad de todos aquellos datos que comunique a FRESHTASTE y será el único responsable de las manifestaciones falsas o inexactas que realice.
                
                El usuario se compromete expresamente a hacer un uso adecuado de los contenidos y servicios de FRESHTASTE y a no emplearlos de manera fraudulenta y dañina.
            </p>            
        </div>

        <div class="politica-privacidad">
            <h3>Propiedad Intelectual e Industrial</h3>
            <hr>
            <p> 
                Los textos, imágenes, logos, signos distintivos, sonidos, animaciones, vídeos, código fuente y resto de contenidos incluidos en el presente sitio web son titularidad de FRESHTASTE, o dispone en su caso, del derecho de uso y explotación de los mismos, y en tal sentido se erigen como obras protegidas por la legislación de propiedad intelectual e industrial vigentes.

                Cualquier transmisión, distribución, reproducción o almacenamiento, total o parcial, de los contenidos almacenados en esta web, queda expresamente prohibido salvo previo y expreso consentimiento del titular. No obstante, los Usuarios podrán llevar a cabo la reproducción o almacenamiento de los contenidos de la web para su exclusivo uso personal, quedando expresa y terminantemente prohibida la reproducción de elementos o contenidos de esta web, realizados con ánimo de lucro o fines comerciales.
            </p>            
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
