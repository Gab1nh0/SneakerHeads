<?php
session_start(); 
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
        <?php
            include("cond_db.php");
            echo "<h2>Bienvenido, " . $_SESSION["usuario"] . ".</h2>";
        ?>
    </div>
</body>
</html>