<?php
require_once "../modelo/pedidos.modelo.php";

class controladorpedidos{

    static public function ctrpedidos($id_cliente,$fecha_pedido,$total){
        $respuesta = modelopedidos::mdlagregarpedido($id_cliente,$fecha_pedido,$total);
        return $respuesta;
    }
    static public function ctrdetallepedidos($id_pedido,$id_producto,$cantidad,$precio_unitario,$subtotal){
        $respuesta = modelopedidos::mdlagregardetalle($id_pedido,$id_producto,$cantidad,$precio_unitario,$subtotal);
        return $respuesta;
    }

}
 
?>