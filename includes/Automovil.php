<?php
class Automovil {
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles"; // Nombre de la tabla

    // Propiedades de la clase
    public $marca;
    public $modelo;
    public $anio;
    public $color;
    public $placa;
    public $num_motor;
    public $num_chasis;
    public $tipo_vehiculo;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar() {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (marca, modelo, año, color, placa, num_motor, num_chasis, tipo_vehiculo) VALUES (:marca, :modelo, :anio, :color, :placa, :num_motor, :num_chasis, :tipo_vehiculo)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->num_motor = htmlspecialchars(strip_tags($this->num_motor));
        $this->num_chasis = htmlspecialchars(strip_tags($this->num_chasis));
        $this->tipo_vehiculo = htmlspecialchars(strip_tags($this->tipo_vehiculo));

        // Enlazar los parámetros
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":num_motor", $this->num_motor);
        $stmt->bindParam(":num_chasis", $this->num_chasis);
        $stmt->bindParam(":tipo_vehiculo", $this->tipo_vehiculo);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para buscar un automóvil por placa
    public function buscarPorPlaca($placa) {
        // Query para buscar por placa
        $query = "SELECT * FROM " . $this->table_name . " WHERE placa = :placa LIMIT 0,1";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->execute();

        // Obtener los datos
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron resultados
        if ($row) {
            // Asignar los valores obtenidos a las propiedades del objeto
            $this->marca = $row['marca'];
            $this->modelo = $row['modelo'];
            $this->anio = $row['año'];
            $this->color = $row['color'];
            $this->placa = $row['placa'];
            $this->num_motor = $row['num_motor'];
            $this->num_chasis = $row['num_chasis'];
            $this->tipo_vehiculo = $row['tipo_vehiculo'];            

            return $row; // Devuelve los datos encontrados
        }

        return null; // Si no se encuentra el automóvil
    }

    // Método para actualizar un automóvil
    public function actualizar() {
        // Query para actualizar los datos
        $query = "UPDATE " . $this->table_name . " 
                  SET marca = :marca, modelo = :modelo, anio = :anio, color = :color, placa = :placa 
                  WHERE id = :id";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar los parámetros
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':anio', $this->anio);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para eliminar un automóvil
    public function eliminar() {
        // Query para eliminar el automóvil por ID
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar el ID
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar el ID
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>

