<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

// Obtener los datos del formulario
$automovil->marca = $_POST['marca'];
$automovil->modelo = $_POST['modelo'];
$automovil->anio = $_POST['anio'];
$automovil->color = $_POST['color'];
$automovil->placa = $_POST['placa'];
$automovil->num_motor = $_POST['num_motor'];    
$automovil->num_chasis = $_POST['num_chasis'];
$automovil->tipo_vehiculo = $_POST['tipo_vehiculo'];
// Agregar el valor de la placa


// Registrar el automóvil
if ($automovil->registrar()) {
    echo "<script>
        alert('Registro realizado exitosamente');
        setTimeout(function(){
            window.location.href = 'index.php';
        }, 5000); // Redirect after 5 seconds
        </script>";
} else {
    echo "Error al registrar el automóvil.";
}

// Método para buscar un automóvil por placa
if (isset($_GET['buscar'])) {
    $placa = $_GET['placa'];
    $resultado = $automovil->buscarPorPlaca($placa);
    if ($resultado) {
        echo "Automóvil encontrado: " . json_encode($resultado);
    } else {
        echo "No se encontró ningún automóvil con la placa: " . $placa;
    }
}

// Método para actualizar los datos de un automóvil
if (isset($_POST['actualizar'])) {
    $automovil->id = $_POST['id'];
    $automovil->marca = $_POST['marca'];
    $automovil->modelo = $_POST['modelo'];
    $automovil->anio = $_POST['anio'];
    $automovil->color = $_POST['color'];
    $automovil->placa = $_POST['placa'];

    if ($automovil->actualizar()) {
        echo "Automóvil actualizado exitosamente.";
    } else {
        echo "Error al actualizar el automóvil.";
    }
}

// Método para eliminar un automóvil
if (isset($_POST['eliminar'])) {
    $automovil->id = $_POST['id'];
    if ($automovil->eliminar()) {
        echo "Automóvil eliminado exitosamente.";
    } else {
        echo "Error al eliminar el automóvil.";
    }
}
?>
