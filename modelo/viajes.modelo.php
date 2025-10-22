<?php
require_once "conexion.php";
class modeloviajes{
    static public function mdlmostrarpedidos(){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("SELECT pedidos.id_pedido,clientes.nombre,productos.producto,pedidos_productos.cantidad,
                                    clientes.direccion,productos.precio,pedidos.total
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