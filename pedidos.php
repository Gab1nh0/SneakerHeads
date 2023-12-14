<?php
include("cond_db.php");

// Iniciar la sesión
session_start();
if (isset($_SESSION['id_cliente'])) {
    $id_cliente = $_SESSION['id_cliente'];

    $stmt = $conn->prepare("SELECT * FROM cliente WHERE id_cliente = ?");
    $stmt->bind_param("s", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $usuario = $row['usuario'];
        $correo = $row['correo'];
        $contrasena = $row['contrasena'];
        $rol = $row['rol'];
    } else {
        echo "No se encontró el cliente con el ID proporcionado.";
        exit;
    }
} else {
    echo "ID de cliente no proporcionado.";
    exit;
}

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
                <a href="perfil.php"><i class="ri-account-circle-line"></i> <p>Perfil</p></a>
                <a href="pedidos.php"><i class="ri-shopping-bag-line"></i><p>Pedidos</p></a>
                <a href="#"><i class="ri-heart-line"></i><p>Favoritos</p></a>
                <?php
                if ($_SESSION['rol'] == 'administrador') {
                    echo '<a href="marcas"><i class="ri-bar-chart-line"></i><p>Marcas</p></a>';
                    echo '<a href="zapatillas.php"><i class="ri-boxing-line"></i><p>Zapatillas</p></a>';
                }
                ?>
                <a href="logout.php"><i class="ri-logout-box-line"></i><p>Cerrar Sesión</p></a> 
            </div>      
        </div>
        
    </div>
    <div class="content">
        <h1>Pedidos</h1>
        <div class="pedidos-container">
        <?php
if (isset($_SESSION["usuario"])) {

    // Consultar los pedidos del cliente desde la tabla pedidos
    $sql_pedidos = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente'";
    $result_pedidos = $conn->query($sql_pedidos);

    // Mostrar la lista de pedidos
    if ($result_pedidos->num_rows > 0) {

        while ($row_pedido = $result_pedidos->fetch_assoc()) {
            echo "<div class='pedido-solo'>";
            echo "<div class='pedido-solo-datos'>";
            echo "<p>ID del Pedido: " . $row_pedido['id_pedido'] . "</p>";
            echo "<p>ID del Producto: " . $row_pedido['id_producto'] . "</p>";
            echo "<p>Cantidad: " . $row_pedido['cantidad'] . "</p>";
            echo "<p>Fecha del Pedido: " . $row_pedido['fecha_pedido'] . "</p>";
            echo "</div>";

            // Consultar la ruta de la imagen del producto
            $sql_pedidos2 = "SELECT rutaImagen FROM producto WHERE id_producto = '" . $row_pedido['id_producto'] . "'";
            $result_pedidos2 = $conn->query($sql_pedidos2);

            if ($result_pedidos2->num_rows > 0) {
                $row_pedido2 = $result_pedidos2->fetch_assoc();
                echo "<div class='pedido-solo-img'>";
                echo "<img src='" . $row_pedido2['rutaImagen'] . "'>";
                echo "</div>";
            }

            echo "</div>";
            echo "<hr>";
        }
    } else {
        echo "<p>No hay pedidos realizados.</p>";
    }
} else {
    // Si el usuario no está autenticado, redireccionar a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>


        </div>
    </div>
</body>
</html>