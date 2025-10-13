<?php
require_once "conexion.php"; 

class ModeloViajes {

  //Agregar Viaje
    static public function ModeloAgregarViaje($tabla, $datos) {

        try {
            $stmt = Conexion::conectar()->prepare("
                INSERT INTO $tabla (destino, carga, cliente, fecha_salida)
                VALUES (:destino, :carga, :cliente, :fecha_salida)
            ");

            $stmt->bindParam(":destino",  $datos["destino"],  PDO::PARAM_STR);
            $stmt->bindParam(":carga",   $datos["carga"],   PDO::PARAM_STR);
            $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_salida", $datos["fecha_salida"], PDO::PARAM_STR);

            return $stmt->execute() ? "ok" : "error";

        } catch (PDOException $e) {
            // Podés registrar errores si querés depurar
            error_log("Error en modeloAgregarViaje: " . $e->getMessage());
            return "error";
        }
    }

    
}
?>
