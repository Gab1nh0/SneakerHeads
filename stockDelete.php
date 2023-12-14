<?php

include("api/models/zapatillas.php");

if (isset($_GET['id'])) {

    $id_producto = $_GET['id'];

    $eliminacion_exitosa = Zapatillas::delete($id_producto);

    if ($eliminacion_exitosa) {
        echo "Zapatilla eliminada con éxito.";
    } else {
        echo "Error al eliminar la zapatilla.";
    }

    
}
header("Location: stock.php");
?>