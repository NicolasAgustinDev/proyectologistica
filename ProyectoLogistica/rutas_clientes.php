<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require_once "conexion.php";

$id_ruta = $_SESSION['id_ruta'];
$sql = "SELECT nombre, direccion FROM clientes WHERE id_ruta = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_ruta);
$stmt->execute();
$clientes = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logística</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="estilo/logi.css">

</head>
<body>

<!-- NAVBAR CON IMAGEN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo como imagen -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="imagenes/logo.png" alt="Logo" style="height: 40px; width: auto;" class="me-2">
      <span>Logística</span>
    </a>
    <!-- Buscador -->
    <div class="d-flex align-items-center gap-2">
      <div class="input-group search-group">
        <input type="text" id="busquedaDireccion" class="form-control form-control-sm" placeholder="Buscar dirección...">
        <button class="btn btn-outline-light btn-sm" id="btnBuscar">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>

    <!-- Botón Mapa -->
    <button class="btn btn-sm" title="Mostrar mapa" id="btnMostrarMapa">
        <i class="fas fa-map-marked-alt text-white"></i>
    </button>

    <!-- Botón responsive -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

   <!-- Menú desplegable  -->
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="clientes.php">Clientes</a></li>
          <li><a class="dropdown-item" href="servicios.php">Servicios</a></li>
          <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>


<!-- CONTENIDO -->
<div class="container mt-5">
  <div class="text-center">
    <h1 class="mb-3">Bienvenido a Logistic Company</h1>
    <p class="lead">Gestión integral de transporte y rutas.</p>
  </div>
</div>

<!-- MAPA -->
<div id="mapa">
  <center>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d105073.27471185336!2d-58.515871658472946!3d-34.61579593254165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca3b4ef90cbd%3A0xa0b3812e88e88e87!2sBuenos%20Aires%2C%20Cdad.%20Aut%C3%B3noma%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1752445403848!5m2!1ses!2sar" 
      width="700" 
      height="470" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </center>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>-->
<script src="javaScript/mapa.js"></script>
</body>
</html>
