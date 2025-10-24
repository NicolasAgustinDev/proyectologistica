<?php require_once "../sectores/parte_superior.php" ?>
    <h1>Historial de Viajes</h1>
    <div>
        <table id="historial_viajes" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Camion</th>
                    <th>Chofer</th>
                    <th>Direccion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>


    <!-- 1. jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Data tables -->
    <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <!-- Fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="js/historial_viajes.js"></script>
    

<?php require_once "../sectores/parte_inferior.php" ?>

