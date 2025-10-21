<?php require_once "../sectores/parte_superior.php" ?>
        <h1>Pedidos</h1>
        <div>
            <label for="id_cliente">Cliente</label>
            <select id="id_cliente" name="id_cliente" class="form-control" required></select>
        </div>
        <div>
            <label for="fecha_pedido">Fecha</label>
            <input type="date" id="fecha_pedido" name="fecha_pedido" placeholder="Ingrese una fecha" required>
        </div>

        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">Agregar Productos</button>
        </div>
        <!-- MODAL -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Productos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div>
                        <table id="productos" class="display" style="width:100%">
                            <thead>
                                <th>Id_producto</th>
                                <th>Producto</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                            </thead>
                        </table>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <table id="pedidos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div>
            <h3>
                Total: $<span id="TotalGeneralMostrar">0</span>
                <input type="hidden" id="TotalGeneral">
            </h3>
        </div>
        <div>
            <button type="button" id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary">Cerrar</button>
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
        <script src="js/pedidos.js"></script>
<?php require_once "../sectores/parte_inferior.php" ?>