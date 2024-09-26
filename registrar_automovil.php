<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css"/>
    <title>Registro de Automóviles</title>
</head>
<body>
    <h2>Registrar Automóvil</h2>
    <form action="procesar_registro.php" method="post">
        <label for="marca">Marca:</label> 
        <input type="text" id="marca" name="marca" required><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br>

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
</body>
</html>
