<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="perfil.css" rel="stylesheet">
    <title>Nueva Zapatilla</title>
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
        <h1>Registro de Productos</h1>
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post" enctype="multipart/form-data">
        
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <br>
            <label for="precio">Precio:</label><br>
            <input type="text" id="precio" name="precio" required><br><br>
            <br>
            <label for="modelo">Modelo:</label><br>
            <input type="text" id="modelo" name="modelo" required><br><br>
            <br>
            <label for="marca">Marca:</label><br>
            <input type="text" id="marca" name="marca" required><br><br>
            <br>
            <label for="categoria">Categoría:</label><br>
            <select id="categoria" name="categoria" required>
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
                <option value="nino">Niño</option>
            </select><br><br>
            <br>
            
            <label for="imagen">Imagen:</label><br>
            <input type="file" id="imagen" name="imagen" required><br><br>
            <br>
            <button class="anadir-zapas-btn" type="submit" name="btn-registrar">
            <i class="ri-save-line"></i> Guardar </button>

        </form>
        <br>
        <p><a href="stock.php" class="a-sin-estilo"> <i class="ri-arrow-left-line"></i> Regresar</a></p>
        <?php

include("api/models/zapatillas.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-registrar"])) {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];

    // Image
    $target_dir = "img/";
    $imagenTmp = $_FILES["imagen"]["tmp_name"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $rutaImagen = $target_dir . $nombreImagen;

    // Generate a UUID for the product ID
    $id_producto = uniqid();

    // Call the static insert method directly without creating an instance
    if (Zapatillas::insert($id_producto, $nombre, $precio, $modelo, $marca, $categoria, $rutaImagen)) {
        echo "Producto registrado correctamente.";
    } else {    
        echo "Error al registrar el producto.";
    }
}

?>
    </div>




</body>
</html>

