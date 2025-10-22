<?php require_once "../sectores/parte_superior.php"?>

<h1>Viajes</h1>
<div>
    <div>
        <div>
            <label for="id_ruta">Ruta</label>
            <select id="id_ruta" name="id_ruta" class="form-control" required></select>
        </div>
        <div>
            <label for="id_vehiculo">Vehiculo</label>
            <select id="id_vehiculo" name="id_vehiculo" class="form-control" required></select>
        </div>
        <div>
            <label for="id_chofer">Chofer</label>
            <select id="id_chofer" name="id_chofer" class="form-control"  required></select>
        </div>
        <div>
            <label for="fecha_salida">Fecha</label>
            <input type="date" id="fecha_salida" name="fecha_salida" placeholder="Ingrese una fecha" class="form-control" required>
        </div>
    </div>
    <div>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">Agregar Pedidos</button>
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Pedidos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table id="pedidos" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id Pedido</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <table id="viajes" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id Pedido</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Direccion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>

    <div>
        <button type="button" id="guardar" name="guardar" class="btn btn-primary">Guardar Viaje</button>
    </div>
</div>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
        <!-- FontAwesome -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/viajes.js"></script>

<?php require_once "../sectores/parte_inferior.php"; ?>
