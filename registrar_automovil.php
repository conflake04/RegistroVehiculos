<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css"/>
    <title>Registro de Automóviles</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Registrar Automóvil</h2>
    <form action="procesar_registro.php" method="post">
        <label for="marca">Marca:</label> 
        <select class="lista" name="marca" id="marca">
            <option value="">Seleccione la marca del automovil</option>
            <?php
            include 'includes/Database.php';
            include 'includes/Marca.php';

            $database = new Database();
            $db = $database->getConnection();

            $marca = new Marca($db);
            
            $stmt = $marca->traerMarcas();
            
            if ($stmt->rowCount() > 0) {
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_marca = $row['id_marca'];
                    $nombre_marca = $row['nombre_marca'];

                    echo "<option value='{$id_marca}'>{$nombre_marca}</option>";

                }
            } else {
                echo "<option value=''>No hay marcas disponibles</option>";
            }
            ?>
        </select>

        <label for="modelo">Modelo:</label>
        <select class="lista" name="modelo" id="modelo">
            <option value="">Seleccione un modelo</option>
        </select>

        <label for="anio">Año:</label>
        <input type="number" id="anio" name="anio" required><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br>

        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required><br>

        <label for="num_motor">Num. Motor:</label>
        <input type="text" id="num_motor" name="num_motor" required><br>

        <label for="num_chasis">Num. Chasis:</label>
        <input type="text" id="num_chasis" name="num_chasis" required><br>

        <label for="tipo_vehiculo">Tipo de Vehículo:</label>
        <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" required><br>
        
        <input type="submit" value="Registrar">
    </form>

    <script>
    // Ejecutar el código cuando el documento HTML esté completamente cargado
        $(document).ready(function() {
            
            // Detectar el evento de cambio en el combobox de marca
            $('#marca').change(function() {
                // Obtener el valor seleccionado del combobox de marca
                var marcaID = $(this).val();
                
                // Verificar si se ha seleccionado una marca válida
                if (marcaID) {
                    // Realizar una solicitud AJAX para obtener los distritos de la marca seleccionada
                    $.ajax({
                        type: 'POST', // Método de solicitud HTTP (POST) para enviar los datos al servidor
                        url: 'ajax/Modelo.php', // URL del archivo PHP que manejará la solicitud y devolverá los distritos
                        data: { id_marca: marcaID }, // Datos enviados en la solicitud, en este caso, el ID de la marca seleccionada
                        success: function(html) {
                            // Si la solicitud tiene éxito, actualizar el combobox de modelo con los datos recibidos (opciones HTML)
                            $('#modelo').html(html);
                        },
                        error: function(xhr, status, error) {
                            // Manejo de errores en caso de que la solicitud falle
                            console.error('Error al obtener los modelos:', error);
                        }
                    });
                } else {
                    // Si no se selecciona una provincia, restablecer el combobox de modelo a su opción predeterminada
                    $('#modelo').html('<option value="">Seleccione el modelo</option>');
                }
            });
        });
    </script>
</body>
</html>
