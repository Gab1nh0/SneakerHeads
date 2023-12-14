<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

if (!isset($_COOKIE['sesion_iniciada'])) {
    // Almacena el mensaje en una variable de sesión
    $_SESSION['mensaje_carrito'] = "Debes iniciar sesión para ver tu carrito";

    // Redirigir al usuario a la página de inicio de sesión
    header('refresh:2;url=login.php');
    echo "Debes iniciar sesion o registrarte.";
    exit();
}
// Verificar si se ha enviado el formulario
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    // Crear una nueva entrada en el carrito de la sesión
    $producto = array(
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => 1
    );

    // Verificar si el carrito ya existe en la sesión
    if (isset($_SESSION['carrito'])) {
        // Agregar el nuevo producto al carrito existente
        $_SESSION['carrito'][] = $producto;
    } else {
        // Crear un nuevo carrito y agregar el producto
        $_SESSION['carrito'] = array($producto);
    }

    // Redirigir de nuevo a la página principal con un mensaje de éxito
    header('refresh:2;url=home.php?mensaje=Producto agregado al carrito');
    echo "Producto agregado al carrito. Redirigiendo...";
    exit();
}
?>


</body>
</html>