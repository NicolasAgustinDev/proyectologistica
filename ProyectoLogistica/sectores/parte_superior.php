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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">  
    <link rel="stylesheet" href="estilo/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Botón toggle sidebar -->
            <button id="toggleSidebar" class="btn btn-outline-light me-3 d-lg-inline-block d-none">☰</button>
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="imagenes/logo.png" alt="Logo" style="height: 40px;" class="me-2">
                <span>Logistic Company</span>
            </a>
            <!-- Navbar toggler para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Contenido colapsable -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <!-- Buscador centrado -->
                <form class="d-flex mx-auto my-2" role="search" style="max-width: 400px; width: 100%;">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Buscar dirección..." aria-label="Buscar">
                    <button class="btn btn-outline-light btn-sm me-2 d-lg-inline-block d-none" id="btnMapa">
                    <i class="bi bi-geo-alt-fill"></i>
                    </button>
                </form>
            </div>
            <!-- Acciones del usuario -->
            <div class="d-flex align-items-center ms-auto">
                
                <span class="text-light me-3">Usuario: Jonathan</span>
                <a href="cerrar_sesion.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5 class="text-center">Menú</h5>
            <h5><a href="viajes.php"><i class="fas fa-route me-2"></i> Viajes</a></h5>
            <h5><a href="clientes.php"><i class="fas fa-users me-2"></i> Clientes</a></h5>
            <h5><a href="choferes.php"><i class="fas fa-id-card me-2"></i> Choferes</a></h5>
            <h5><a href="vehiculos.php"><i class="fas fa-truck me-2"></i> Vehículos</a></h5>
            <!--<h5><a href="ejemplo.php"><i class="fas fa-tachometer-alt me-2"></i> Ejemplo</a></h5>-->
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!--inicio del contenido -->