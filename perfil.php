<?php
include("cond_db.php");

// Iniciar la sesión
session_start();

if ($_SESSION['rol'] == 'administrador') {
    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];
    
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE id_admin = ?");
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
}else{

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
                <a href="logout.php"><i class="ri-logout-box-line"></i><p>Cerrar Sesión</p></a> 
            </div>      
        </div>
        
    </div>
    <div class="content">
        <h1>Actualizar Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-izq">
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
                
                    <label for="apellido">Apellido:</label><br>
                    <input type="text" name="apellido" value="<?php echo $apellido; ?>"><br>
                
                    <label for="usuario">Usuario:</label><br>
                    <input type="text" name="usuario" value="<?php echo $usuario; ?>"><br><br><br>
                
                    <input class="actualizar" type="submit" name="btn-actualizar" value="Actualizar Cliente">
                
                </div>

                <div class="form-der">
                <label for="correo">Correo:</label><br>
                <input type="email" name="correo" value="<?php echo $correo; ?>"><br>
                
                <label for="contrasena">Contraseña:</label><br>
                <input type="password" name="contrasena" value="<?php echo $contrasena; ?>"><br>

                <label for="rol">Rol:</label><br>
                <input type="text" name="rol" value="<?php echo $rol; ?>"><br>

                </div>
                
                
                
        </form>

        <?php
            include("cond_db.php");
                
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-actualizar"])) {
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $usuario = $_POST["usuario"];
                $correo = $_POST["correo"];
                $contrasena = $_POST["contrasena"];
                $rol = $_POST["rol"];

                $stmt = $conn->prepare("UPDATE cliente SET nombre=?, apellido=?, usuario=?, correo=?, contrasena=?, rol=? WHERE id_cliente=?");
                $stmt->bind_param("ssssssi", $nombre, $apellido, $usuario, $correo, $contrasena, $rol, $usuario_id);

                if ($stmt->execute()) {
                    echo "Cliente actualizado correctamente.";
                    } else {
                    echo "Error al actualizar el cliente: " . $conn->error;
                }

                $stmt->close();
            }

            $conn->close();

        ?>
        
    </div>
    </div>
</body>
</html>