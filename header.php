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