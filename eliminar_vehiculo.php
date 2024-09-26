<?php
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar la clase Automovil
$automovil = new Automovil($db);

// Obtener el ID del vehículo a eliminar
if (isset($_POST['id'])) {
    $automovil->id = $_POST['id'];

    if ($automovil->eliminar()) {
        echo "Vehículo eliminado exitosamente.";
    } else {
        echo "Error al eliminar el vehículo.";
    }
}
?>
