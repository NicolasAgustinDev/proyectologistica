<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require_once "conexion.php";

$nombre_conductor = "samanta";
$apellido_conductor = "ortega";
$hay_planes_disponibles = false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo/index.css">
</head>
<body>

    <div class="top-half">
        <img src="imagenes/logo.png" alt="Logo" class="logo-img mb-3">
        <div>Conductor</div>
        <div class="conductor-nombre">
            <?php echo strtoupper($nombre_conductor . " " . $apellido_conductor); ?>
        </div>
    </div>

    <div class="bottom-half">
        <a href="rutas_clientes.php" class="btn btn-primary btn-lg btn-planes">Buscar planes</a>
        <?php if (!$hay_planes_disponibles): ?>
            <p class="planes-msg">No tienes planes disponibles</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

