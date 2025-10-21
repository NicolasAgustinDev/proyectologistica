<?php
require_once "../modelo/rutas.modelo.php";
require_once "../controladores/rutas.controlador.php";
$rutas=controladorrutas::ctrmostrarrutas();
header('Content-Type: application/json');
echo json_encode($rutas);
?>