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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="estilo/rutas.css">
  <script src="javaScript/mapa.js"></script>
  <script src="javaScript/buscador.js"></script>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid justify-content-between">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="imagenes/logo.png" alt="Logo" style="height: 40px;" class="me-2">
      <span>Logística</span>
    </a>

    <!-- Grupo de búsqueda y botones -->
<div class="d-flex align-items-center gap-2">
  <!-- Buscador -->
  <div class="input-group input-group-sm">
    <input type="text" id="busquedaDireccion" class="form-control" placeholder="Buscar dirección...">
    <button class="btn btn-outline-light" id="btnBuscar"><i class="bi bi-search"></i></button>
  </div>

  <!-- Botón mapa -->
  <button class="btn btn-outline-light btn-sm" id="btnMapa"><i class="bi bi-geo-alt-fill"></i></button>
</div>

<!-- 🔽 Mapa separado del grupo de botones -->
<div class="container mt-3" id="mapaContenedor" style="display: none;">
  <div class="ratio ratio-16x9">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.151703382456!2d-58.3831004!3d-34.8069437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcc59ed2e3f4c1%3A0xf16a5c18eebcfc04!2sAlmirante%20Brown%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1627589099876!5m2!1ses!2sar"
      width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>


      <!-- Menú tres puntos -->
      <div class="position-relative">
        <button id="btnOpciones" class="btn btn-outline-light btn-sm">
          <i class="bi bi-three-dots-vertical"></i>
        </button>
        <div id="menuOpciones" class="card shadow position-absolute end-0 mt-2 d-none" style="z-index: 1000; min-width: 200px;">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="cerrar_sesion.php" class="text-decoration-none">Cerrar Sesión</a></li>
            <li class="list-group-item"><a href="editar_viajes.php" class="text-decoration-none">Editar Viajes</a></li>
            <li class="list-group-item"><a href="editar_secuencia_rutas.php" class="text-decoration-none">Editar secuencia de rutas</a></li>
            <li class="list-group-item"><a href="registar_evento.php" class="text-decoration-none">Registrar Evento</a></li>
            <li class="list-group-item"><a href="asignar_asistente.php" class="text-decoration-none">Asignar Asistente</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container mt-4 contenido">
  <div class="row align-items-center mb-4">
    <div class="col-6">
      <h5><i class="bi bi-person-fill"></i> Nicolas Garcia</h5>
    </div>
    <div class="col-6 text-end">
      <h5><i class="bi bi-truck-front-fill"></i> ABC123</h5>
    </div>
  </div>

  <hr>

  <div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Visitas</th>
        <th>Eventos</th>
      </tr>
    </thead>
    <tbody id="tablaVisitas">
      <tr>
        <td>Centenario 281</td>
        <td>08:00hs</td>
      </tr>
      <tr>
        <td>LaMadrid 123</td>
        <td>08:15hs</td>
      </tr>
      <tr>
        <td>Alsina</td>
        <td>08:25hs</td>
      </tr>
    </tbody>
  </table>
</div>


  <hr>

  <div class="mt-4">
    <p class="direccion-texto">📍 Centenario 281</p>
    <button type="button" class="btn btn-dark w-100" id="btnComenzarRuta">Comenzar Ruta</button>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const btnOpciones = document.getElementById('btnOpciones');
  const menuOpciones = document.getElementById('menuOpciones');
 

  btnOpciones.addEventListener('click', () => {
    menuOpciones.classList.toggle('d-none');
  });

  document.addEventListener('click', (e) => {
    if (!btnOpciones.contains(e.target) && !menuOpciones.contains(e.target)) {
      menuOpciones.classList.add('d-none');
    }
  });

</script>

</body>
</html>
