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
            <h3 >Condiciones del Servicio</h3>
            <hr>
            <p>FRESHTASTE ALIMENTACIÓN, S.L.
                Dirección Postal: C/ San Francisco, 28004, Las Rozas, Madrid (ESPAÑA).
                Datos fiscales: NIF: 000000080
                Contacto: info@freshtaste.com
                El presente contrato electrónico se celebra en cumplimiento de la normativa española y en concreto bajo el régimen legal impuesto por la Ley 34/2002 de Servicios de la Sociedad de la Información y el Comercio Electrónico (LSSICE) y por el Real Decreto Legislativo 1/2007, de 16 de noviembre, por el que se aprueba el texto refundido de la Ley General para la Defensa de los Consumidores y Usuarios (TRLGDCU). 
                
                El contrato electrónico se presenta al consumidor en castellano. Las presentes Condiciones Generales de la Contratación podrán ser guardadas y reproducidas en cualquier momento por el usuario (en adelante, el Usuario o el Cliente, indistintamente) que realice una compra mediante las opciones de su navegador de internet, y deben ser aceptadas antes de proceder al pago de los productos. 
                
                Asimismo, en el email de confirmación de la compra que le remitimos, incluimos el enlace a las presentes Condiciones Generales de la Contratación.
            </p>                  
        </div>

        <div class="politica-privacidad">
            <h3>Productos y servicios</h3>
            <hr>
            <p> FRESHTASTE es un servicio online de platos preparados y entregados a domicilio.
                Los platos y la ficha descriptiva con detalles sobre la preparación y su precio. 
                
                FRESHTASTE se reserva el derecho de decidir, en cada momento, los productos y servicios que se ofrecen a los Clientes. De este modo, FRESHTASTE podrá, en cualquier momento, añadir nuevos productos y servicios a los ofertados actualmente. 
                
                Asimismo FRESHTASTE se reserva el derecho a retirar o dejar de ofrecer, en cualquier momento, y sin previo aviso, cualesquiera de los productos y servicios ofrecidos. 
                
                Todo ello sin perjuicio de que la adquisición de los productos y servicios sólo podrá hacerse mediante el registro del Usuario. 
                
                El Cliente creará su nombre de “Usuario” y “Contraseña”, a través de los medios proporcionados por FRESHTASTE en la plataforma, los cuales le identificarán y habilitarán personalmente para poder tener acceso a los productos y servicios. 
            </p>            
        </div>

        <div class="politica-privacidad">
            <h3>Precio</h3>
            <hr>
            <p> FRESHTASTE muestra en su web el precio total de cada producto incluyendo el IVA.  
                El coste total del producto, junto con los gastos de envío, será facilitado antes de que se formalice la compra.                        
                
                Si como Cliente o Usuario de la web detecta cualquiera de estos errores, le animamos a que nos informe de ello para que FRESHTASTE pueda corregirlo.
                
                Toda la información relativa al precio, productos, especificaciones, campañas promocionales y servicios podrá ser modificada en cualquier momento por FRESHTASTE. 
                
                Si como Cliente ha realizado una compra y dispone del ticket, podrá solicitar factura electrónica poniéndose en contacto con nosotros a través del teléfono, a través de formulario web indicando el número de pedido, la fecha y el importe de la operación, y le enviaremos una copia de la factura por email. 
                
                El envío de la factura en papel no queda condicionado al pago de cantidad económica alguna. La llamada al número de teléfono de contacto no supone un coste superior al coste de una llamada a una línea telefónica fija geográfica.
            </p>            
        </div>

        <div class="politica-privacidad">
            <h3>Formas de Pago</h3>
            <hr>
            <p>
                FRESHTASTE dispone de diversas modalidades de pago. Una vez que el Cliente realiza el pedido puede seleccionar  entre los diferentes sistemas de pago que FRESHTASTE pone a disposición de los Clientes.
                Algunos medios de pago son gestionados por las empresas propietarias de dichos medios de pago, por lo que FRESHTASTE declina cualquier tipo de responsabilidad en los problemas derivados de la utilización de estos sistemas o plataformas ajenas a FRESHTASTE.
             
                El pago mediante tarjeta de crédito/débito utilizado en FRESHTASTE implica que la información de la tarjeta del Cliente se remitirá directamente a la entidad bancaria. Esta entidad accede a los datos identificativos del Cliente y datos de la compra efectuada relacionados con el proceso de pago. Para más información, puedes consultar las condiciones y política de privacidad de las entidades bancarias.
                
                FRESHTASTE no recaba ni trata ningún dato del Cliente relativo a su número de tarjeta. Todos los datos son tratados directamente por el proveedor de pago. El pago de tu pedido se realiza directamente con dicha entidad.               
                               
                Si el Cliente o Usuario de la web tiene alguna duda al respecto, puede contactar con FRESHTASTE por teléfono o a través del formulario de la web.    
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