<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu tienda online</title>
    <!-- Enlaza tus archivos CSS -->
    <link rel="stylesheet" href="styles.css">
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
                        <img  src="imagenes/login.svg" width="22px" onclick="openModal()">                        
                    </li>
                </ul>            
            </nav>
            <?php endif; ?> <!-- Fin de la verificación de la sesión -->
            
            <nav class="carrito-responsive">
                <ul>
                    <li>
                        <img src="imagenes/cart.svg" alt="Carrito de compras" onclick="openCartModal()">
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
                        echo'<a href="destruir_sesion.php"><img  src="imagenes/cross.svg" width="10px" height="10px"> Cerrar sesión</a>';                
                    }
                ?>      
            </nav>
        </div>         
    </header>

    <!-- Modal para el carrito de compras -->
    <div id="ModalCarrito" class="modal-carrito">
        <div class="modal-content">
            <!-- Contenido del modal (como el carrito de compras) -->
            <!-- Aquí puedes agregar cualquier contenido adicional que desees mostrar en el modal -->
            <h2>Carrito de Compras</h2>
            <!-- Aquí puedes agregar la lista de productos del carrito -->
            <button onclick="closeCartModal()">Cerrar</button>
        </div>
    </div>

    <!-- Tus otros elementos HTML y scripts -->
    <!-- Enlaza tus archivos JavaScript -->
    <script src="scripts.js"></script>
</body>
</htm
