<?php
require_once("../controladores/choferes.controlador.php");
require_once("../modelo/choferes.modelo.php");
class choferes{
    public $id_chofer;
    public $nombre;
    public $apellido;
    public $telefono;
    public $licencia;

    public function mostrarchoferes(){
        $respuesta = controladorchoferes::ctrmostrarchoferes();
        echo json_encode($respuesta);
    }
    public function agregarchoferes(){
        $respuesta = controladorchoferes::ctragregarchoferes($this -> nombre,$this -> apellido,$this -> telefono,$this -> licencia);
        echo json_encode($respuesta);
    }
    public function modificarchoferes(){
        $respuesta = controladorchoferes::ctrmodificarchoferes($this -> id_chofer,$this -> nombre,$this -> apellido,$this -> telefono,$this -> licencia);
        echo json_encode($respuesta);
    }
    public function eliminarchoferes(){
        $respuesta = controladorchoferes::ctreliminarchoferes($this -> id_chofer);
        echo json_encode($respuesta);
    }
}
if(!isset($_POST["accion"])){
    $respuesta = new choferes();
    $respuesta -> mostrarchoferes();
}else{
    if($_POST["accion"]=="registrar"){
        $registrar = new choferes();
        $registrar -> nombre =$_POST["nombre"];
        $registrar -> apellido =$_POST["apellido"];
        $registrar -> telefono =$_POST["telefono"];
        $registrar -> licencia =$_POST["licencia"];
        $registrar -> agregarchoferes();
    }
    if($_POST["accion"]=="modificar"){
        $modificar = new choferes();
        $modificar -> id_chofer =$_POST["id_chofer"];
        $modificar -> nombre =$_POST["nombre"];
        $modificar -> apellido =$_POST["apellido"];
        $modificar -> telefono =$_POST["telefono"];
        $modificar -> licencia =$_POST["licencia"];
        $modificar -> modificarchoferes();
    }
    if($_POST["accion"]=="eliminar"){
        $eliminar = new choferes();
        $eliminar -> id_chofer =$_POST["id_chofer"];
        $eliminar -> eliminarchoferes();
    }
}
?>