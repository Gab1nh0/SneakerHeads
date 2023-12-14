<?php
include_once("api/models/zapatillas.php");


    if (isset($_GET['id'])) {

        $id_producto = $_GET['id'];
    
        $zapatillas = Zapatillas::getWhere($id_producto);
        foreach ($zapatillas as $zapatilla) {
            $zapatilla['nombre'];
        }
        
            
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="perfil.css" rel="stylesheet">
    <title>Editar Zapatilla</title>
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
        <h1>Editar Productos</h1>
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post" enctype="multipart/form-data">
        <?php
        foreach ($zapatillas as $zapatilla) {
         echo '
            <form>
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="' . $zapatilla['nombre'] . '" required><br><br>
                <br>
                <label for="precio">Precio:</label><br>
                <input type="number" id="precio" name="precio" value="' . $zapatilla['precio'] . '" required><br><br>
                <br>
                <label for="modelo">Modelo:</label><br>
                <input type="text" id="modelo" name="modelo" value="' . $zapatilla['modelo'] . '" required><br><br>
                <br>
                <label for="marca">Marca:</label><br>
                <input type="text" id="marca" name="marca" value="' . $zapatilla['marca'] . '" required><br><br>
                <br>
                <label for="categoria">Categoría:</label><br>
                <select id="categoria" name="categoria" value="' . $zapatilla['categoria'] . '" required>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                    <option value="nino">Niño</option>
                </select><br>
                <br>
                <br>
                <button class="anadir-zapas-btn" type="submit" name="btn-registrar">
                    <i class="ri-save-line"></i> Guardar </button>
            </form>
            ';
        }
        ?>

        <br>
        <p><a href="stock.php" class="a-sin-estilo"> <i class="ri-arrow-left-line"></i> Regresar</a></p>
    </div>

        <?php

            include("api/models/zapatillas.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-registrar"])) {
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $modelo = $_POST["modelo"];
            $marca = $_POST["marca"];
            $categoria = $_POST["categoria"];
            $descripcion = $_POST["descripcion"];

            //imagen
            $target_dir = "img/";
            $imagenTmp = $_FILES["imagen"]["tmp_name"];
            $nombreImagen = $_FILES["imagen"]["name"];
            $rutaImagen = $target_dir . $nombreImagen; ;

            // pone un ID random
            $str = rand();
            $id_producto = md5($str);

            // Call the static insert method directly without creating an instance
            if (Zapatillas::update($id_producto, $nombre, $precio, $modelo, $marca, $categoria, $rutaImagen)) {
                echo "Producto actualizado correctamente.";
            } else {
                echo "Error al actualizado el producto.";
            }
        }

        ?>

</body>
</html>

