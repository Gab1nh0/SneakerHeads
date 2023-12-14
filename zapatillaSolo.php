<?php
session_start();
include("api/models/zapatillas.php"); 
if (isset($_GET['id'])) {

    $id_producto = $_GET['id'];

    $zapatillas = Zapatillas::getWhere($id_producto);
    foreach ($zapatillas as $zapatilla) {
    
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
    <link href="header.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <link href="zapatillSolo.css" rel="stylesheet">
    <title>Zapatilla</title>
</head>
<body>
    <br>
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
    <div class="content-imagen">
    <p><?php echo $zapatilla['categoria']; ?> / <?php echo $zapatilla['marca']; ?> / <?php echo $zapatilla['modelo']; ?></p>
        <img src="<?php echo $zapatilla['rutaImagen']; ?>" alt="">
    </div>

    <div class="content-texto">

    <h1><?php echo $zapatilla['nombre']; ?></h1>
    <h2><?php echo $zapatilla['marca']; ?> <?php echo $zapatilla['modelo']; ?></h2>
    <p><i class="ri-check-line"></i> En Stock</p>

    <br>
    
    <table>
    <thead>
      <tr>
        <th>Tipo</th>
        <th>EE. UU.</th>
        <th>UE</th>
        <th>UK</th>
        <th>Centímetros</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Hombre</td>
        <td>8</td>
        <td>41</td>
        <td>7.5</td>
        <td>26</td>
      </tr>
      <tr>
        <td>Mujer</td>
        <td>9.5</td>
        <td>40</td>
        <td>7</td>
        <td>25.5</td>
      </tr>
      <tr>
        <td>Niño</td>
        <td>5</td>
        <td>28</td>
        <td>4.5</td>
        <td>17.5</td>
      </tr>
      
    </tbody>
  </table>


  <br>
    <div class="izquierda-compra">
      <?php 
    echo '
    <div class="boton-carrito-container-solo">
    <!-- Agrega el botón "Agregar al Carrito" con un formulario -->
    <form method="post" action="carrito_registro.php">
        <input type="hidden" name="id_producto" value="' . $zapatilla['id_producto'] . '">
        <input type="hidden" name="nombre" value="' . $zapatilla['nombre'] . '">
        <input type="hidden" name="precio" value="' . $zapatilla['precio'] . '">
        <button class="boton-carrito" type="submit"><i class="ri-shopping-cart-line"></i>Agregar al Carrito</button>
    </form>
    </div>';
  ?>
        </div>
  
    </div>
</div>
</body>
</html>