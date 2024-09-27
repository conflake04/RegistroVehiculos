<?php
include '../includes/Database.php'; 

$database = new Database();
$pdo = $database->getConnection();

if (isset($_POST['id_marca'])) {
    
    $id_marca = $_POST['id_marca'];

    // Consulta para obtener los distritos de la provincia seleccionada
    $stmt = $pdo->prepare("SELECT * FROM modelo WHERE id_marca = ?");
    $stmt->execute([$id_marca]);

    // Verificar si hay marcas encontrados
    if ($stmt->rowCount() > 0) {
        echo '<option value="">Seleccione el modelo</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id_modelo'] . '">' . htmlspecialchars($row['nombre_modelo']) . '</option>';
        }
    } else {
        echo '<option value="">No hay marcas disponibles</option>';
    }
}
?>