<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require_once "modelo/conexion.php";

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    
    <!-- Pone icono mas gruesos -->
    <style>
    /* Establece la altura del mapa */
    #map {
      width: 100%;
      height: 400px;
    }
  </style>
    
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
                    <input class="form-control form-control-sm" type="search" placeholder="Buscar dirección..." aria-label="Buscar">
                    <!-- Botón del mapa (type=button evita enviar el form) -->
                    <button type="button" class="btn btn-outline-light btn-sm me-2 d-lg-inline-block" data-bs-toggle="modal" data-bs-target="#mapModal">
                        <i class="bi bi-geo-alt-fill"></i>
                    </button>
                </form>
            </div>

            <!-- Acciones del usuario -->
            <div class="d-flex align-items-center ms-auto">
                <span class="text-light me-3">Usuario: Samanta</span>
                <a href="cerrar_sesion.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>
    <!-- Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">Mapa de Almirante Brown</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
    </div>
  </div>
</div>
    <!-- Contenedor del mapa (afuera del form y navbar) -->
    

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
             <h5 class="text-center">Menú</h5>
            <h5><a href="viajes.php"><i class="fas fa-route me-3"></i><span class="link-text">Viajes</span></a></h5>
            <h5><a href="pedidos.php"><i class="fas fa-clipboard-list me-3"></i><span class="link-text">Pedidos</span></a></h5>
            <h5><a href="clientes.php"><i class="fas fa-users me-3"></i><span class="link-text">Clientes</span></a></h5>
            <h5><a href="choferes.php"><i class="fas fa-id-card me-3"></i><span class="link-text">Choferes</span></a></h5>
            <h5><a href="vehiculos.php"><i class="fas fa-truck me-3"></i><span class="link-text">Vehículos</span></a></h5>
            <h5><a href="productos.php"><i class="fas fa-box me-3"></i><span class="link-text">Productos</span></a></h5>
            
            <!--<h5><a href="ejemplo.php"><i class="fas fa-tachometer-alt me-2"></i> Ejemplo</a></h5>-->
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!--inicio del contenido -->
