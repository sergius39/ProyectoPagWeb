<?php
session_start();
$nombreUsuario = isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : null;
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
            <nav class="iconos-carritoLogin login-responsive">                
                <ul>
                    <li>                                          
                        <img  src="imagenes/login.svg" width=22px onclick="openModal()">                        
                    </li>
                </ul>
            
                <?php endif; ?> <!-- Fin de la verificación de la sesión -->
            </nav>

            <nav class="carrito-responsive ">
                <ul>
                    <li>
                        <img src="imagenes/cart.svg" id="img-carrito" alt="">                     
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

             <nav class="navbar cerrar_sesion cierra_sesion_responsive">                
                <?php 
                    if ($nombreUsuario) { 
                        echo'<a href="destruir_sesion.php"><img  src="imagenes/cross.svg" width=10px height=10px> Cerrar sesión</a>';                
                    }
                ?>      
            </nav>
        </div>         
    </header>


    
    <section class="products container">

        <div class="politica-privacidad">
            <h3 >Politica de Privacidad</h3>
            <hr>
            <p>En cumplimiento de lo establecido en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos, así como cualquier otra normativa aplicable en materia de Protección de Datos, les facilitamos información ampliada en la presente Política de Privacidad.
            </p>                  
        </div>

        <div class="politica-privacidad">
            <h3>¿Quién es el responsable del tratamiento de los datos?</h3>
            <hr>
            <p> FRESHTASTE ALIMENTACIÓN, S.L. Dirección Postal: C/ San Francisco, 28004, Las Rozas, Madrid (ESPAÑA). Teléfono: 620 52 69 43 Correo electrónico: info@freshtaste.com
            </p>            
        </div>

        <div class="politica-privacidad">
            <h3>¿Por cuánto tiempo conservaremos los datos?</h3>
            <hr>
            <p>Los datos personales proporcionados se conservarán por el tiempo imprescindible para la realización de la venta on-line y durante los plazos legalmente establecidos.</p>            
        </div>

        <div class="politica-privacidad">
            <h3>¿A qué destinatarios se comunicarán sus datos?</h3>
            <hr>
            <p>Los datos se comunicarán a proveedores como, por ejemplo, empresas de logística, empresas de marketing y empresas de alojamiento de la web. 
        
            Para cumplir las finalidades indicadas en la presente Política de Privacidad y en la Política de Cookies, es necesario que terceros puedan acceder a parte de los datos personales del interesado para poder prestar el servicio:
        
            <ul>
            <li>Entidades financieras.</li>
            <li>Entidades de detección y prevención de fraude.</li>
            <li>Proveedores de servicios tecnológicos.</li>
            <li>Proveedores y colaboradores de servicios de logística, transporte y entrega.</li>
            <li>Proveedores y colaboradores de servicios relacionados con marketing.</li>
            </ul>

        </p>         
        </div>
 
        <div class="politica-privacidad">
            <h3>¿Cuáles son los derechos de los interesados respecto a sus datos?</h3>
            <hr>
            <p>Cualquier interesado tiene derecho a obtener información sobre sus datos personales tratados así como ejercitar los derechos que le asisten sobre los mismos:
        
            Derecho de acceso: las personas interesadas tienen derecho a acceder a sus datos personales. 
            Derecho de rectificación de los datos: por ser estos inexactos o haber sufrido modificaciones.
            Derecho de supresión: la persona interesada solicita la eliminación de sus datos.
            Derecho de oposición: la persona interesada solicita que no se lleve a cabo un determinado tratamiento de sus datos personales o cese el mismo como, por ejemplo, la recepción de comunicaciones comerciales.
            En determinadas circunstancias en las que las personas interesadas soliciten  limitar el tratamiento de sus datos personales, únicamente serán conservados para el ejercicio o la defensa de reclamaciones y atender las obligaciones legales durante el periodo estrictamente necesario a estos efectos.
        
            Podrá ejercitar materialmente sus derechos enviando un correo electrónico a rgpd@knoweats.com identificándose debidamente e indicando de forma expresa el derecho que se quiere ejercer. 
        
            Si la persona interesada otorgó su consentimiento para alguna finalidad concreta, el interesado tiene derecho a retirar el consentimiento otorgado en cualquier momento, sin que ello afecte a la licitud del tratamiento basado en el consentimiento previo a su retirada. 
        
            En caso de que la persona interesada sienta vulnerados sus derechos en lo concerniente a la protección de los datos personales, especialmente cuando no haya obtenido satisfacción en el ejercicio de sus derechos, puede presentar una reclamación ante la Autoridad de Control en materia de Protección de Datos competente a través de su sitio web: </p>
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

<!-- Modal -->
<div id="myModal" class="modal">
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

<script src="script.js"></script>

</body>
</html>