<?php
require_once "conexion.php";

class modelopedidos{

    static public function mdlagregarpedido($id_cliente,$fecha,$total){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO pedidos(id_cliente,fecha_pedido,total)VALUES(:id_cliente,:fecha,:total)");
        $st -> bindParam(":id_cliente",$id_cliente,PDO::PARAM_STR);
        $st -> bindParam(":fecha",$fecha,PDO::PARAM_INT);
        $st -> bindParam(":total",$total,PDO::PARAM_INT);

        if($st -> execute()){
            $id_pedido = $conexion -> lastInsertId();
            return $id_pedido;
        }else{
            return false;
        }
    }

    static public function mdlagregardetalle($id_pedido){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO pedido_productos(id_pedido,id_producto,cantidad,precio_unitario,subtotal)VALUES()");
    }
     
}
?>