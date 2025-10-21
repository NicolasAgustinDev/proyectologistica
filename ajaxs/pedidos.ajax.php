<?php
require_once "../modelo/pedidos.modelo.php";
require_once "../controladores/pedidos.controlador.php";
class pedidos{
    public $id_pedido;
    public $id_cliente;
    public $fecha_pedido;
    public $total;
    public $id_producto;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;

    public function agregarpedido(){
        $respuesta = controladorpedidos::ctrpedidos($this -> id_cliente,$this -> fecha_pedido,$this -> total);
        echo json_encode($respuesta);
    }

    public function agregardetallepedido(){
        $respuesta = controladorpedidos::ctrdetallepedidos($this -> id_pedido,$this -> id_producto,$this -> cantidad,$this -> precio_unitario,$this -> subtotal);
        echo json_encode($respuesta);
    }
}

if(isset($_GET["detalle"]) && $_GET["detalle"] == 1){
    $guardar = new pedidos;
    $guardar -> id_pedido = $_POST["id_pedido"];
    $guardar -> id_producto = $_POST["id_producto"];
    $guardar -> cantidad = $_POST["cantidad"];
    $guardar -> precio_unitario = $_POST["precio_unitario"];
    $guardar -> subtotal = $_POST["subtotal"];
    $guardar -> agregardetallepedido();    
}else{
    $guardar = new pedidos;
    $guardar -> id_cliente = $_POST["id_cliente"];
    $guardar -> fecha_pedido = $_POST["fecha_pedido"];
    $guardar -> total = $_POST["total"];
    $guardar -> agregarpedido();
}
?>