<?php
class Marca {

    private $conn;
    private $table_name = "marca";

    public $id_marca;
    public $nombre_marca;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre_marca) VALUES (:nombre_marca)";

        $stmt = $this->conn->prepare($query);

        $this->limpiar();

        $stmt->bindParam(":nombre_marca", $this->nombre_marca);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function traerMarcas() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre_marca = :nombre_marca WHERE id_marca = :id_marca";

        $stmt = $this->conn->prepare($query);

        $this->limpiar();

        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":nombre_marca", $this->nombre_marca);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function borrar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_marca = :id_marca";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_marca", $this->id_marca);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function limpiar() {
        $this->nombre_marca = htmlspecialchars(strip_tags($this->nombre_marca));
    }
}
?>
