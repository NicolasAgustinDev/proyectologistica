<?php require_once "../sectores/parte_superior.php" ?>

        <h1>Vehiculos</h1>
        <div class="btn-agregar-vehiculos">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">Agregar Vehiculo</button>
        </div>
        <table id="vehiculos" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id.Vehículo</th>
                    <th>Patente</th>
                    <th>Tipo</th>
                    <th>Capacidad (Kg)</th>
                </tr>
            </thead>
        </table>

        <!-- MODAL -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Vehículo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div>
                        <form>
                            <div>
                                <input type="hidden" id="id_vehiculo" name="id_vehiculo">
                                <div class="mb-3">
                                    <label for="patente">Patente: </label>
                                    <input type="text" id="patente" name="patente" placeholder="Ingrese la patente" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo">Tipo: </label>
                                    <input type="text" id="tipo" name="tipo" placeholder="Ingrese el tipo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="capacidad_kg">Capacidad (Kg): </label>
                                    <input type="number" id="capacidad_kg" name="capacidad_kg" placeholder="Ingrese la capacidad del vehiculo " required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnguardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- 1. jQuery primero -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Data tables -->
        <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
        <!-- Fontawesome -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/vehiculos.js"></script>

<?php require_once "../sectores/parte_inferior.php" ?>