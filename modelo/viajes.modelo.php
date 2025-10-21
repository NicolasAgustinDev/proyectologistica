<?php
<<<<<<< HEAD:modelo/viajes.modelo.php
require_once "conexion.php";
class modeloviajes{
    static public function mdlmostrarpedidos(){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("SELECT pedidos.id_pedido,clientes.nombre,productos.producto,pedidos_productos.cantidad 
                                    FROM pedidos
                                    INNER JOIN pedidos_productos ON pedidos.id_pedido=pedidos_productos.id_pedido
                                    INNER JOIN clientes ON pedidos.id_cliente=clientes.id_cliente
                                    INNER JOIN productos ON pedidos_productos.id_producto=productos.id_producto;");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);


    }
    static public function mdlagregarviaje($id_ruta,$id_vehiculo,$id_chofer,$fecha_salida){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO viajes(id_ruta,id_vehiculo,id_chofer,fecha_salida)VALUES(:id_ruta,:id_vehiculo,:id_chofer,:fecha_salida)");
        $st -> bindParam(":id_ruta",$id_ruta,PDO::PARAM_INT);
        $st -> bindParam(":id_vehiculo",$id_vehiculo,PDO::PARAM_INT);
        $st -> bindParam(":id_chofer",$id_chofer,PDO::PARAM_INT);
        $st -> bindParam(":fecha_salida",$fecha_salida,PDO::PARAM_STR);

        if($st -> execute()){
            $id_viaje = $conexion -> lastInsertId();
            return $id_viaje;
        }else{
            return false;
        }
    }
    static public function mdlagregardetalleviaje($id_viaje,$id_pedido){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO viajes_productos(id_viaje,id_pedido)VALUES(:id_viaje,:id_pedido)");
        $st -> bindParam(":id_viaje",$id_viaje,PDO::PARAM_INT);
        $st -> bindParam(":id_pedido",$id_pedido,PDO::PARAM_INT);

        if($st -> execute()){
            echo "El detalle de la venta fue agregado correctamente";
        }else{
            echo "El detalle de la venta no fue agregado correctamente";
        }
    }
}

?>
=======
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
>>>>>>> c8f683ac5a7aa9f06e17e02c5b6fcf4157b3b46d:ProyectoLogistica/modelo/viajes.modelo.php
