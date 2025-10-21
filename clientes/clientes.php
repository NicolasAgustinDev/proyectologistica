<?php require_once "../sectores/parte_superior.php" ?>


        <h1>Clientes</h1>
        <div class="btn-agregar-cliente">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal" >Agregar Cliente</button>
        </div>
        <table id="clientes" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id.Cliente</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Ruta</th>
                </tr>
            </thead>
        </table>
        <!-- MODAL -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div>
                        <form>
                            <div>
                                <input type="hidden" id="id_cliente" name="id_cliente">
                                <div class="mb-3">
                                    <label for="nombre">Nombre: </label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion">Dirección: </label>
                                    <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección " required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono">Teléfono: </label>
                                    <input type="number" id="telefono" name="telefono" placeholder="Ingrese el teléfono " required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_ruta">Ruta</label>
                                    <select id="id_ruta" name="id_ruta" class="form-control" required></select>
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
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Data tables -->
        <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
        <!-- Fontawesome -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/clientes.js"></script>
<?php require_once "../sectores/parte_inferior.php" ?>