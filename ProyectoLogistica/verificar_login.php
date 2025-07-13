<?php
session_start();
require_once "conexion.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuarios WHERE usuario = ? AND clave = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $clave);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellido'] = $fila['apellido']; 
    $_SESSION['id_ruta'] = $fila['id_ruta']; // ruta asignada
    header("Location: index.php");
} else {
    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    header("Location: index.php");
}
?>
