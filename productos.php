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

       <section class="products container" id="lista-1">
        <h3 class="platos-semana">Nuestros Platos</h3>
        <hr>

        <div class="products-content">

            <div class="product">
                    <img class="salmon" src="imagenes/salmon a la plancha.jpg" alt="">               
                    <h3>Salmón a la plancha</h3>
                    <p class="ajuste-txt">Delicioso salmón a la plancha acompañado de una cama de verduras</p>
                    <p class="precio">7.50 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="1">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/pollo-salteado-con-verduras-y-almendras.jpg" alt="">
                    <h3>Pollo salteado con verduras y almendras</h3>
                    <p>Apetecible pollo a la plancha con verduras y un toque de almendras</p>
                    <p class="precio">7 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="2">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/pasta con salsa de verduras.jpg" alt="">
                    <h3>Pasta con salsa de verduras</h3>
                    <p class="ajuste-txt">Date un capricho con este delicioso plato de pasta con salsa de verduras</p>
                    <p class="precio">8 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="3">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/pimientos rellenos.jpg" alt="">
                    <h3>Pimientos rellenos de quinoa</h3>
                    <p>Sanísimos y deliciosos pimientos rellenos de quinoa, pruebalos!</p>
                    <p class="precio">7 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="4">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/albondigas.jpg" alt="">
                    <h3>Albóndigas en salsa con arroz</h3>
                    <p>Increibles albóndigas con un sabor tradicional</p>
                    <p class="precio ajuste-txt">8 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="5">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/arroz-viudo-con-setas.jpg" alt="">
                    <h3>Arroz viudo con setas</h3>
                    <p>Sabrosísimo arroz con un toque a setas</p>
                    <p class="precio ajuste-txt">8 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id=6">Agregar al carrito</a>
            </div>

            <div class="product">
                <img src="imagenes/berenjenas-rellenas.jpg" alt="">
                    <h3>Berenjenas rellenas</h3>
                    <p>berenjenas al horno que te dejarán con ganas de más</p>
                    <p class="precio ajuste-txt">8 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="7">Agregar al carrito</a>
            </div>  

        </div>

        <h3 class="platos-crema">Nuestras Cremas</h2>
        <hr>

            <div class="products-content">

                <div class="product">
                    <img src="imagenes/crema-de-guisantes.jpg" alt="">
                        <h3>Crema de guisantes</h3>
                        <p>Deliciosa crema de Guisantes que hará que repitas</p>
                        <p class="precio ajuste-txt">6.50 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="8">Agregar al carrito</a>
                </div>  
    
                <div class="product">
                    <img src="imagenes/crema-fria-esparragos.jpg" alt="">
                        <h3>Crema fría de espárragos</h3>
                        <p>Refrescante y sabrosa crema de espárragos</p>
                        <p class="precio ajuste-txt">6 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="9">Agregar al carrito</a>
                </div>
    
                <div class="product">
                    <img src="imagenes/crema-fria-zanahoria.jpg" alt="">
                        <h3>Crema fría de zanahorias</h3>
                        <p>Crema de zanahorias que ofrece un sabor suave y fresco</p>
                        <p class="precio">6 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="10">Agregar al carrito</a>
                </div>      
                                 
            </div>

        <h3 class="platos-crema">Nuestras Pizzas</h2>
        <hr>

        <div class="products-content">

            <div class="product">
                <img src="imagenes/pizzas-saudables-champinon.jpg" alt="">
                    <h3>Pizza de salvia y champiñón</h3>
                    <p>Impresionante pizza de champiñones acompañada por el toque fresco de la salvia</p>
                    <p class="precio ">12.50 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="11">Agregar al carrito</a>
            </div>
    
            <div class="product">
                <img src="imagenes/pizatortilla.jpg" alt="">
                    <h3>Pizza de champiñones y aceitunas</h3>
                    <p>Prueba nuestra pizza con base de tortilla, te sorprenderá</p>
                    <p class="precio">12.50 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="12">Agregar al carrito</a>
            </div>
    
            <div class="product">
                <img src="imagenes/pizzaesparrago.jpg" alt="">
                    <h3>Pizza de espárragos y calabacín</h3>
                    <p>Deliciosa pizza de espárragos con calabacin que te hara la boca agua</p>
                    <p class="precio">11 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="13">Agregar al carrito</a>
            </div>      
                              
            <div class="product">
                <img src="imagenes/pizza-caliente.webp" alt="">
                    <h3>Pizza de tomatitos y albahaca</h3>
                    <p>Espectacular pizza de de tomate con el toque fresco de la albahaca</p>
                    <p class="precio">13.50 €</p>
                    <a href=""class="agregar-carrito btn-2" data-id="14">Agregar al carrito</a>
            </div>    
        </div>

        <h3 class="platos-crema">Nuestras Ensaladas</h2>
            <hr>
    
            <div class="products-content">
    
                <div class="product">
                    <img src="imagenes/pollo con guarnición.jpg" alt="">
                        <h3>Ensalada de Pollo</h3>
                        <p>Prueba nuestra impresionante ensalada de pollo con mango y aguacate</p>
                        <p class="precio">7.50 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="15">Agregar al carrito</a>
                </div>
        
                <div class="product">
                    <img src="imagenes/ensalada griega.jpg" alt="">
                        <h3>Ensalada griega</h3>
                        <p>Traemos el sabor griego a tu mesa</p>
                        <p class="precio ajuste-txt">7.50 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="16">Agregar al carrito</a>
                </div>
        
                <div class="product">
                    <img src="imagenes/ensaladacesar.jpg" alt="">
                        <h3>Ensalada César</h3>
                        <p>No podía faltar la famosísima ensalada César</p>
                        <p class="precio ajuste-txt">9 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="17">Agregar al carrito</a>
                </div>      
                                  
                <div class="product">
                    <img src="imagenes/ensaladanicoise.jpg" alt="">
                        <h3>Ensalada niçoise</h3>
                        <p>Desconocida pero no por ello, espectacular ensalada que viene de Francia</p>
                        <p class="precio">7.50 €</p>
                        <a href=""class="agregar-carrito btn-2" data-id="18">Agregar al carrito</a>
                </div>    
            </div>

            <h3 class="platos-crema">Nuestros Postres</h2>
                <hr>
        
                <div class="products-content">
        
                    <div class="product">
                        <img src="imagenes/crema-de-papaya-con-helado-y-frutos-rojos.jpg" alt="">
                            <h3>Crema de papaya con helado y frutos rojos</h3>
                            <p>Fresca y suave crema de helado con papaya y un toque de frutos rojos</p>
                            <p class="precio">3.50 €</p>
                            <a href=""class="agregar-carrito btn-2" data-id=19">Agregar al carrito</a>
                    </div>
            
                    <div class="product">
                        <img src="imagenes/milhojas de queso fresco y kiwi.jpg" alt="">
                            <h3>Milhojas de queso fresco y kiwi</h3>
                            <p>Mezcla el sabor tradicional con el toque ácido del kiwi</p>
                            <p class="precio ajuste-txt">2.50 €</p>
                            <a href=""class="agregar-carrito btn-2" data-id="20">Agregar al carrito</a>
                    </div>
            
                    <div class="product">
                        <img src="imagenes/milhojas-de-frutas.jpg" alt="">
                            <h3>Milhojas de frutas</h3>
                            <p>Una versión diferente de las milhojas de toda la vida</p>
                            <p class="precio ajuste-txt">2.50 €</p>
                            <a href=""class="agregar-carrito btn-2" data-id="21">Agregar al carrito</a>
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