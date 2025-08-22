<?php
require_once "conexion.php";
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">           
        <title>Editar Viajes</title>
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
                            <li class="list-group-item"><a href="viajes.php" class="text-decoration-none">Viajes</a></li>
                            <li class="list-group-item"><a href="clientes.php" class="text-decoration-none">Clientes</a></li>
                            <li class="list-group-item"><a href="choferes.php" class="text-decoration-none">Choferes</a></li>
                            <li class="list-group-item"><a href="vehiculos.php" class="text-decoration-none">Vehiculos</a></li>
                            <li class="list-group-item"><a href="cerrar_sesion.php" class="text-decoration-none">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <h1>Viajes</h1>



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