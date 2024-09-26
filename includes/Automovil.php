<?php
class Automovil {
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles"; // Nombre de la tabla

    // Propiedades de la clase
    public $id_marca;
    public $id_modelo;
    public $anio;
    public $color;
    public $placa;
    public $num_motor;
    public $num_chasis;
    public $id_tipovehiculo;
    public $id_propietario;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar() {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (id_marca, id_modelo, año, color, placa, num_motor, num_chasis, id_tipovehiculo, id_propietario) VALUES (:id_marca, :id_modelo, :anio, :color, :placa, :num_motor, :num_chasis, :id_tipovehiculo, :id_propietario)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));
        $this->id_modelo = htmlspecialchars(strip_tags($this->id_modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->num_motor = htmlspecialchars(strip_tags($this->num_motor));
        $this->num_chasis = htmlspecialchars(strip_tags($this->num_chasis));
        $this->id_tipovehiculo = htmlspecialchars(strip_tags($this->id_tipovehiculo));
        $this->id_propietario = htmlspecialchars(strip_tags($this->id_propietario));

        // Enlazar los parámetros
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_modelo", $this->id_modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":num_motor", $this->num_motor);
        $stmt->bindParam(":num_chasis", $this->num_chasis);
        $stmt->bindParam(":id_tipovehiculo", $this->id_tipovehiculo);
        $stmt->bindParam(":id_propietario", $this->id_propietario);

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
            $this->id_marca = $row['id_marca'];
            $this->id_modelo = $row['id_modelo'];
            $this->anio = $row['año'];
            $this->color = $row['color'];
            $this->placa = $row['placa'];
            $this->num_motor = $row['num_motor'];
            $this->num_chasis = $row['num_chasis'];
            $this->id_tipovehiculo = $row['id_tipovehiculo'];
            $this->id_propietario = $row['id_propietario'];

            return $row; // Devuelve los datos encontrados
        }

        return null; // Si no se encuentra el automóvil
    }

    // Método para actualizar un automóvil
    public function actualizar() {
        // Query para actualizar los datos
        $query = "UPDATE " . $this->table_name . " 
                  SET id_marca = :id_marca, id_modelo = :id_modelo, anio = :anio, color = :color, placa = :placa 
                  WHERE id = :id";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));
        $this->id_modelo = htmlspecialchars(strip_tags($this->id_modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar los parámetros
        $stmt->bindParam(':id_marca', $this->id_marca);
        $stmt->bindParam(':id_modelo', $this->id_modelo);
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

