<?php
require_once "conexion.php";
class modeloproductos{
    static public function mdlmostrarproductos(){
        $st = conexion::conectar() -> prepare("SELECT * FROM productos");
        $st -> execute();
        return $st -> fetchAll(PDO::FETCH_ASSOC);
    }
    static public function mdlagregarproductos($nombre,$descripcion,$stock,$precio){
        $st = conexion::conectar() -> prepare("INSERT INTO productos(nombre,descripcion,stock,precio) VALUES(:nombre,:descripcion,:stock,:precio)");
        $st -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $st -> bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
        $st -> bindParam(":stock",$stock,PDO::PARAM_INT);
        $st -> bindParam(":precio",$precio,PDO::PARAM_INT);
        if($st -> execute()){
            echo("El producto fue ingresado correctamente");
        }else{
            echo("El producto no fue ingresado correctamente");
        }
    }

    static public function mdlmodificarproductos($id_producto,$nombre,$descripcion,$stock,$precio){
        $st = conexion::conectar() -> prepare("UPDATE productos SET nombre=:nombre,descripcion=:descripcion,stock=:stock,precio=:precio WHERE id_producto=:id_producto");
        $st -> bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
        $st -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $st -> bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
        $st -> bindParam(":stock",$stock,PDO::PARAM_INT);
        $st -> bindParam(":precio",$precio,PDO::PARAM_INT);
        if($st -> execute()){
            echo("El producto fue modificado correctamente");
        }else{
            echo("El producto no fue modificado correctamente");
        }
    }
    static public function mdleliminarproductos($id_producto){
        $st = conexion::conectar() -> prepare("DELETE FROM productos WHERE id_producto=:id_producto");
        $st -> bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
        if($st -> execute()){
            echo("El producto fue eliminado correctamente");
        }else{
            echo("El producto no fue eliminado correctamente");
        }
        
    }
}
?>