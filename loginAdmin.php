<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login-izquierda">
        <div class="login-izquierda-interior">
            <div class="titulo"><h1>SneakerHeads</h1></div>
            <div class="image-sneakerhead">
            <img class="sneaker-head-1" src="img/sneaker-head.png" alt="">
            <img class="sneaker-head-2" src="img/sneaker-head-2.png" alt="">
        </div>
        </div>
        
    </div>
    <div class="login-derecha">
        <div class="links-superiores">
            <a href="home.php"><i class="ri-arrow-left-line"></i>Regresar al inicio</a>
            <a href="registro.php">Crear una cuenta nueva</a>
        </div>
        <br><br><br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="formulario-inicio">

            <h2>Iniciar Sesión Administrador</h2>
            <br><br>
            
            <input type="text" id="usuario" name="usuario" placeholder="Nombre" required>

            <br><br>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contrasena" required>
            

            <p>Olvido su Contraseña? <a href="#"></a>Recuperala</p>

            <input id="enviar" type="submit" value="Iniciar Sesión" >

        </form>
        <?php

        // Verifica si hay un mensaje en la variable de sesión
        if (isset($_SESSION['mensaje_carrito'])) {
            echo "<p>{$_SESSION['mensaje_carrito']}</p>";
            // Elimina el mensaje para que no se muestre nuevamente
            unset($_SESSION['mensaje_carrito']);
        }
            include("cond_db.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = $_POST["usuario"];
                $contrasena = $_POST["contrasena"];

                // Verificar las credenciales en la base de datos
                $sql = "SELECT * FROM administradores WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Usuario autenticado
                    $row = $result->fetch_assoc();

                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario_id'] = $row['id_admin'];
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['rol'] = $row['rol'];

                    // Crear cookie de sesión
                    setcookie('sesion_iniciada', '1', time() + (86400 * 30), '/');

                    // Redirigir al usuario a la página principal después de iniciar sesión
                    header("Location: home.php");
                } else {
                    echo "<br>Credenciales incorrectas bb. Inténtalo de nuevo.";
                }
            }
        ?>
    </div>

    
</body>
</html>