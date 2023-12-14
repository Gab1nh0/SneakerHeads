<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
</head>
<body>
<?php
// En la página de cerrar sesión (logout.php por ejemplo)
session_start();

// Limpiar variables de sesión
session_unset();
session_destroy();

// Eliminar cookie
setcookie('sesion_iniciada', '', time() - 3600, '/'); // Establece el tiempo de expiración en el pasado

// Redireccionar al usuario al inicio de sesión
header('Location: home.php');
exit();
?>
</body>
</html>