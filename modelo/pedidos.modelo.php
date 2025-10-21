<?php
require_once "conexion.php";

class modelopedidos{

    static public function mdlagregarpedido($id_cliente,$fecha_pedido,$total){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO pedidos(id_cliente,fecha_pedido,total)VALUES(:id_cliente,:fecha_pedido,:total)");
        $st -> bindParam(":id_cliente",$id_cliente,PDO::PARAM_INT);
        $st -> bindParam(":fecha_pedido",$fecha_pedido,PDO::PARAM_STR);
        $st -> bindParam(":total",$total,PDO::PARAM_INT);

        if($st -> execute()){
            $id_pedido = $conexion -> lastInsertId();
            return $id_pedido;
        }else{
            return false;
        }
    }

    static public function mdlagregardetalle($id_pedido,$id_producto,$cantidad,$precio_unitario,$subtotal){
        $conexion = conexion::conectar();
        $st = $conexion -> prepare("INSERT INTO pedidos_productos(id_pedido,id_producto,cantidad,precio_unitario,subtotal)VALUES(:id_pedido,:id_producto,:cantidad,:precio_unitario,:subtotal)");
        $st -> bindParam(":id_pedido",$id_pedido,PDO::PARAM_INT);
        $st -> bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
        $st -> bindParam(":cantidad",$cantidad,PDO::PARAM_INT);
        $st -> bindParam(":precio_unitario",$precio_unitario,PDO::PARAM_INT);
        $st -> bindParam(":subtotal",$subtotal,PDO::PARAM_INT);

        if($st -> execute()){
            echo "El detalle de producto fue agregado correctamente";
        }else{
            echo "El detalle de producto no fue agregado correctamente";
        }
    }
}
?>