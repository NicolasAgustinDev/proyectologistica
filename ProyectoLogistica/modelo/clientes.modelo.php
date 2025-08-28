<?php
require_once "conexion.php";
class modeloclientes{
    static public function mdlmostrarclientes(){
        $st = conexion::conectar() -> prepare("SELECT clientes.id_cliente,clientes.nombre,clientes.direccion,clientes.telefono,rutas.ruta 
                                             FROM clientes 
                                             JOIN rutas ON clientes.id_ruta=rutas.id_ruta");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
    static public function mdlagregarclientes($nombre,$direccion,$telefono,$id_ruta){
        $st = conexion::conectar() -> prepare("INSERT INTO clientes (nombre,direccion,telefono,id_ruta) VALUES(:nombre,:direccion,:telefono,:id_ruta)");
        $st -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $st -> bindParam(":direccion",$direccion,PDO::PARAM_STR);
        $st -> bindParam(":telefono",$telefono,PDO::PARAM_INT);
        $st -> bindParam(":id_ruta",$id_ruta,PDO::PARAM_INT);
        if($st -> execute()){
            echo "El cliente fue ingresado correctamente";
        }else{
            echo "El cliente no fue ingresado correctamente";

        }
        
    }
}

?>