<?php
session_start(); 

include_once("api/connection/connection.php");
include_once("api/models/zapatillas.php");

$zapatillas = Zapatillas::getAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="perfil.css" rel="stylesheet">
    <title>Perfil</title>
</head>
<body>
    <div class="side-bar">
        <div class="side-bar-interior">
            <div class="titulo">
                <a href="home.php"><h2>SneakerHeads</h2></a>
            </div>
            <br><br><br>
            <div class="opciones">
                <a href="perfilAdmin.php"><i class="ri-account-circle-line"></i> <p>Perfil</p></a>
                <a href="pedidos.php"><i class="ri-shopping-bag-line"></i><p>Pedidos</p></a>
                <a href="#"><i class="ri-heart-line"></i><p>Favoritos</p></a>
                <a href="stock.php"><i class="ri-boxing-line"></i><p>Stock</p></a>
                <a href="logout.php"><i class="ri-logout-box-line"></i><p>Cerrar Sesión</p></a> 
            </div>      
        </div>
        
    </div>

    <div class="content">

        <h1>Zapatillas</h1><br>
        <button class="anadir-zapas-btn" onclick="window.location.href='stockAnadir.php'"><i class="ri-add-line"></i> Añadir Zapatilla</button><br><br>
        <?php
    // Iterar sobre las zapatillas y mostrar la información
    foreach ($zapatillas as $zapatilla) {
        echo '<div class="zapatillas-conteiner">';

        echo '<div class="zaptillas-conteiner-texto">';
        echo '<h2>' . $zapatilla['nombre'] . '</h2>';
        echo '<p>ID: ' . $zapatilla['id_producto'] . '</p>';
        echo '<p>Precio: $' . $zapatilla['precio'] . '</p>';
        echo '<p>Modelo: ' . $zapatilla['modelo'] . '</p>';
        echo '<p>Categoría: ' . $zapatilla['categoria'] . '</p>';

        echo '<div class="botones-opciones">';
        echo '<button class="eliminar-zapas-btn" onclick="window.location.href=\'stockDelete.php?id=' . $zapatilla['id_producto'] . '\'"><i class="ri-delete-bin-line"></i> Eliminar Zapatilla</button>';
        echo '<button class="update-zapas-btn" onclick="window.location.href=\'stockUpdate.php?id=' . $zapatilla['id_producto'] . '\'"><i class="ri-pencil-line"></i> Editar Zapatilla</button>';
        echo '</div>';
        

        echo '</div>';


        echo '<img src="' . $zapatilla['rutaImagen'] . '" alt="' . $zapatilla['nombre'] . '">';


        echo '</div>';
        
        echo '<hr>';
    }
    ?>
        
    </div>

    

</body>
</html>
