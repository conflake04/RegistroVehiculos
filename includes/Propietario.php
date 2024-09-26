<?php
class Propietario {
    private $conn; 
    private $table_name = "propietarios";

    public $id_propietario;
    public $nombre_completo;
    public $direccion;
    public $telefono;
    public $correo_electronico;
    public $nacionalidad;
    public $genero;
    public $numero_licencia;
    public $fecha_emision_licencia;
    public $fecha_expiracion_licencia;
    public $tipo_licencia;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
        (nombre_completo, direccion, telefono, correo_electronico, nacionalidad, genero, numero_licencia, fecha_emision_licencia, fecha_expiracion_licencia, tipo_licencia) 
        VALUES (:nombre_completo, :direccion, :telefono, :correo_electronico, :nacionalidad, :genero, :numero_licencia, :fecha_emision_licencia, :fecha_expiracion_licencia, :tipo_licencia)";
        
        $stmt = $this->conn->prepare($query);

        $this->limpiarDatos();

        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":correo_electronico", $this->correo_electronico);
        $stmt->bindParam(":nacionalidad", $this->nacionalidad);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":numero_licencia", $this->numero_licencia);
        $stmt->bindParam(":fecha_emision_licencia", $this->fecha_emision_licencia);
        $stmt->bindParam(":fecha_expiracion_licencia", $this->fecha_expiracion_licencia);
        $stmt->bindParam(":tipo_licencia", $this->tipo_licencia);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function traerPropietarios() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function elimanarPropietario() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_propietario = :id_propietario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_propietario", $this->id_propietario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function limpiarDatos() {
        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo_electronico = htmlspecialchars(strip_tags($this->correo_electronico));
        $this->nacionalidad = htmlspecialchars(strip_tags($this->nacionalidad));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->numero_licencia = htmlspecialchars(strip_tags($this->numero_licencia));
        $this->fecha_emision_licencia = htmlspecialchars(strip_tags($this->fecha_emision_licencia));
        $this->fecha_expiracion_licencia = htmlspecialchars(strip_tags($this->fecha_expiracion_licencia));
        $this->tipo_licencia = htmlspecialchars(strip_tags($this->tipo_licencia));
    }
}
?>