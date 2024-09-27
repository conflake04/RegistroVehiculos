<?php
class TipoVehiculo {
    private $conn;
    private $table_name = "tipo_vehiculo"; 

    public $id_tipovehiculo;          
    public $nombre_tipo;      

    public function __construct($db) {
        $this->conn = $db;
    }


    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre_tipo) VALUES (:nombre_tipo)";
        $stmt = $this->conn->prepare($query);

        $this->limpiar();

        $stmt->bindParam(":nombre_tipo", $this->nombre_tipo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function traerTiposVehiculo() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre_tipo = :nombre_tipo WHERE id_tipo = :id_tipo";
        $stmt = $this->conn->prepare($query);

        $this->limpiar();

        $stmt->bindParam(":nombre_tipo", $this->nombre_tipo);
        $stmt->bindParam(":id_tipovehiculo", $this->id_tipo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function borrar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_tipo = :id_tipo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_tipo", $this->id_tipo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    private function limpiar() {
        $this->nombre_tipo = htmlspecialchars(strip_tags($this->nombre_tipo));
    }
}
?>
