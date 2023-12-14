<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="header.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <link href="carrito.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<header>

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
</header>

<div class="content">
<?php

// Verificar si la cookie de sesión está presente
if (!isset($_COOKIE['sesion_iniciada'])) {
    // Almacena el mensaje en una variable de sesión
    $_SESSION['mensaje_carrito'] = "Debes iniciar sesión para ver tu carrito";

    // Redirigir al usuario a la página de inicio de sesión
        header('refresh:2;url=login.php?');
    echo "Debes iniciar sesion o registrarte.";
    exit();
}
// Verificar si hay productos en el carrito
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<h2>Carrito de Compras</h2>";

    foreach ($_SESSION['carrito'] as $index => $producto) {
        echo "<div class='div-carrito'>";
echo "<table class='tabla-carrito'>";
echo "<tr>";
echo "<td><strong>ID Producto:</strong></td>";
echo "<td>" . $producto['id_producto'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><strong>Nombre:</strong></td>";
echo "<td>" . $producto['nombre'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><strong>Precio:</strong></td>";
echo "<td>$" . $producto['precio'] . "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";


        // Botón para eliminar el producto
        echo "<div class='div-eliminar'>";
        echo "<form method='post' action='carrito.php'>";
        echo "<input type='hidden' name='eliminar_producto' value='$index'>";
        echo "<button type='submit'>Eliminar</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
   
    // Verificar si se ha enviado el formulario para eliminar un producto
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_producto'])) {
        $index_a_eliminar = $_POST['eliminar_producto'];

        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$index_a_eliminar]);

        // Reindexar el array para evitar índices faltantes
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
} else {
    header('home.php');
    echo "El carrito está vacío.
    <form action='pedidos.php' method='post'>
        <input class='pedido' type='submit' name='realizar_pedido' value='Realizar Pedido' disabled style='cursor: not-allowed;'>
    </form>";
    exit();
}

?>

<div class="realizar-btn">
    <form action="pedidos.php" method="post">
        <input class='pedido' type="submit" name="realizar_pedido" value="Realizar Pedido">
    </form>
    <a href='home.php'>Volver a la Tienda</a>
</div>
</div>


</body>
</html>