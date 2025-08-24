<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require_once "conexion.php";

$nombre_conductor = "nicolas";
$apellido_conductor = "garcía";
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
        <div>
            <h1>Panel de Control</h1>
        </div>
    </div>
    <div class="d-flex flex-column p-3 bg-dark text-white" style="height: 100vh; width: 220px;">
        <a href="Viajes.php" class="nav-link text-white d-flex align-items-center mb-2">
            <i class="fas fa-route me-2"></i> Viajes
        </a>
        <a href="clientes.php" class="nav-link text-white d-flex align-items-center mb-2">
            <i class="fas fa-users me-2"></i> Clientes
        </a>
        <a href="choferes.php" class="nav-link text-white d-flex align-items-center mb-2">
            <i class="fas fa-id-card me-2"></i> Choferes
        </a>
        <a href="vehiculos.php" class="nav-link text-white d-flex align-items-center mb-2">
            <i class="fas fa-truck me-2"></i> Vehículos
        </a>
    </div>

    <div class="bottom-half">
        <a href="rutas_clientes.php" class="btn btn-primary btn-lg btn-planes">Buscar planes</a><br><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

