<?php
session_start(); 

include_once("api/connection/connection.php");
include_once("api/models/zapatillas.php");

$zapatillas = Zapatillas::getAll(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="header.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <title>SneakerHeads</title>
</head>
<body>

<!-- Encabezado -->
<header>
    <div class="fondo-navbar"></div>
    <div class="nav-bar">
        <div class="titulo">
            <a href="home.php"><h1>SneakerHeads</h1></a>
        </div>
    

        <div class="barra-busqueda"></div>

        <!-- Barra de Navegación -->   
        <div class="links-usuario">
        <!-- Botón del perfil -->
            <?php
            // Verificar si el usuario ha iniciado sesión y tiene un rol definido
            if (isset($_SESSION['rol'])) {
            // Mostrar enlace al perfil del cliente si el rol es 'cliente'
            if ($_SESSION['rol'] == 'cliente') {
                echo '<a href="#"><i class="ri-notification-2-line"></i></a>';
                echo '<a href="favoritos.php"><i class="ri-heart-line"></i></a>';
                echo '<a href="carrito.php"><i class="ri-shopping-cart-line"></i></a>';
                echo '<a href="perfil.php"><i class="ri-user-2-line"></i></a>';
                
            }
            // Mostrar enlace al perfil del administrador si el rol es 'administrador'
            elseif ($_SESSION['rol'] == 'administrador') {
                echo '<a href="#"><i class="ri-notification-2-line"></i></a>';
                echo '<a href="favoritos.php"><i class="ri-heart-line"></i></a>';
                echo '<a href="carrito.php"><i class="ri-shopping-cart-line"></i></a>';
                echo '<a href="PerfilAdmin.php"><i class="ri-user-line"></i></a>';
                }
            } else {
                // Mostrar enlaces para usuarios no autenticados
                echo '<a href="Login.php">Iniciar Sesión</a>';
                echo '<a href="Registro.php">Registrarse</a>';
                echo '<a href="carrito.php"><i class="ri-shopping-cart-line"></i></a>';
            }
            ?>
        </div>
    </div>
    
    

    <div id="slider-container">
        <div id="slider">
            <div class="slide"><img src="img/slider-image-1.png" alt="Imagen 1"></div>
            <div class="slide"><img src="img/slider-image-2.png" alt="Imagen 2"></div>
            <div class="slide"><img src="img/slider-image-3.png" alt="Imagen 3"></div>
        </div>

        <button id="prevBtn">&#9665;</button>
        <button id="nextBtn">&#9655;</button>
    </div>
<script src="slider.js"></script>
</header>


<!-- Barra de Navegación-->  

<div class="container-recomendados">
   <div class="container-recomendado-titulo">
        <h1>Recomendados</h1>
   </div> 

   <div class="container-recomendados-productos">
   <?php
    // Iterar sobre las zapatillas y mostrar la información
    foreach ($zapatillas as $zapatilla) {
        $nombre_url = urlencode($zapatilla['id_producto']);    
        
        echo '<div class="producto">';
        echo '<br>';
        echo "<a class='producto-link' href='zapatillaSolo.php?id=$nombre_url' style='text-decoration: none; color: black;'>";
        echo '<div class="producto-imagen">';
        echo '<img src="' . $zapatilla['rutaImagen'] . '" alt="' . $zapatilla['nombre'] . '">';
        echo '</div>';
        echo '<div class="producto-texto">';
        echo '<h4>' . $zapatilla['nombre'] . '</h4>';
        echo '<p>' . $zapatilla['marca'] . ' '. $zapatilla['modelo'] . '</p>';
        echo '<h3   >$' . $zapatilla['precio'] . '</h3>';
        echo '</div>';
        echo '</a>';
        echo '<br>';
        echo '
        <div class="boton-carrito-container">
        <!-- Agrega el botón "Agregar al Carrito" con un formulario -->
        <form method="post" action="carrito_registro.php">
            <input type="hidden" name="id_producto" value="' . $zapatilla['id_producto'] . '">
            <input type="hidden" name="nombre" value="' . $zapatilla['nombre'] . '">
            <input type="hidden" name="precio" value="' . $zapatilla['precio'] . '">
            <button class="boton-carrito" type="submit"><i class="ri-shopping-cart-line"></i>Agregar al Carrito</button>
        </form>
        </div>';
        echo '</div>';
        

    }
    ?>
   </div>
    
</div>


</body>
</html>