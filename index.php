<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Sistema de Gestión de Automóviles</title>
</head>
<body>
    <h1>Sistema de Gestión de Automóviles</h1>
    <div class="container">
        <a href="registrar_automovil.php">Registrar un nuevo automóvil</a>

        <div class="search-form">
            <h3>Buscar Automóvil por Placa</h3>
            <form action="index.php" method="GET">
                <input type="text" name="placa_buscar" placeholder="Ingrese placa del vehículo" required>
                <input type="submit" value="Buscar">
            </form>
        </div>

        <div class="vehicle-list">
            <?php
            include 'includes/Database.php';
            include 'includes/Automovil.php';

            $database = new Database();
            $db = $database->getConnection();

            $automovil = new Automovil($db);

            if (isset($_GET['placa_buscar'])) {
                $placa = $_GET['placa_buscar'];
                $vehiculo = $automovil->buscarPorPlaca($placa);

                if ($vehiculo) {
                    echo "<h3>Resultados de la búsqueda:</h3>";
                    echo "<table>
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Color</th>
                                <th>Num. Motor</th>
                                <th>Num. Chasis</th>
                                <th>Tipo de vehiculo</th>
                                <th>Acciones</th>
                            </tr>
                            <tr>
                                <td>{$vehiculo['placa']}</td>
                                <td>{$vehiculo['marca']}</td>
                                <td>{$vehiculo['modelo']}</td>
                                <td>{$vehiculo['año']}</td>
                                <td>{$vehiculo['color']}</td>
                                <td>{$vehiculo['num_motor']}</td>
                                <td>{$vehiculo['num_chasis']}</td>
                                <td>{$vehiculo['tipo_vehiculo']}</td>
                                <td>
                                    <form action='eliminar_vehiculo.php' method='POST' onsubmit='return confirm(\"¿Está seguro de que desea eliminar este vehículo?\");'>
                                        <input type='hidden' name='id' value='{$vehiculo['placa']}'>
                                        <input type='submit' class='delete-btn' value='Eliminar'>
                                    </form>
                                </td>
                            </tr>
                          </table>";
                } else {
                    echo "<p>No se encontró ningún vehículo con la placa ingresada.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
