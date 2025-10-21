<?php
require_once "conexion.php";

class MdlAsignaciones {

    static public function mdlAgregarAsignacion($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("
                INSERT INTO $tabla (id_viaje, nombre_chofer, apellido_chofer, licencia, patente, fecha_asignada)
                VALUES (:id_viaje, :nombre_chofer, :apellido_chofer, :licencia, :patente, :fecha_asignada)
            ");
            $stmt->bindParam(":id_viaje", $datos["id_viaje"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre_chofer", $datos["nombre_chofer"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido_chofer", $datos["apellido_chofer"], PDO::PARAM_STR);
            $stmt->bindParam(":licencia", $datos["licencia"], PDO::PARAM_STR);
            $stmt->bindParam(":patente", $datos["patente"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_asignada", $datos["fecha_asignada"], PDO::PARAM_STR);
          
            if ($stmt->execute()) return "ok";
            return "error";
        } catch (PDOException $e) {
            error_log("Error mdlAgregarAsignacion: ".$e->getMessage());
            return "error";
        }
    }

    static public function mdlMostrarAsignaciones($tabla) {
        try {
            $stmt = Conexion::conectar()->prepare("
                SELECT a.*, v.destino, v.fecha_salida 
                FROM $tabla a
                INNER JOIN viajes v ON a.id_viaje = v.id_viaje
                ORDER BY a.id_asignacion DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error mdlMostrarAsignaciones: ".$e->getMessage());
            return [];
        }
    }
}
?>
