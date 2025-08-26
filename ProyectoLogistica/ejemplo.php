

<?php require_once "sectores/parte_superior.php" ?>



<h1>Clientes</h1>
        <div class="btn-agregar-cliente">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal" >Agregar Cliente</button>
        </div>
        <table id="clientes" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id cliente</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
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
                                <input type="hidden" id="id" name="id">
                                <div class="mb-3">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" id="direccion" name="direccion" placeholder="Ingrese la Direccion " required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono">Telefono:</label>
                                    <input type="number" id="telefono" name="telefono" placeholder="Ingrese el telefono " required>
                                </div>
                                <div class="mb-3">
                                    <label for="ruta">Ruta</label>
                                    <input type="text" id="ruta" name="ruta" placeholder="Ingrese la Ruta " required>
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

        

<script>
            

            $(document).ready(function(){
                let tabla = new DataTable('#clientes', {
                    dom: 'Bfrtip',
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    info:'false',
                    ordering:'false',
                    paging:'false',
                    ajax:{
                        url:'ajaxs/clientes.ajax.php',
                        dataSrc:''
                    },
                    columns:[
                        {data: 'id_cliente'},
                        {data:'nombre'},
                        {data:'direccion'},
                        {data:'telefono'},
                        {data:'id_ruta'},
                        {
                            data:null,
                            render:function(data,type,row){
                                return `<button class="btn btn-principal btneditar" data-bs-target="#miModal" data-bs-toggle="modal">
                                <i class="fa-solid fa-pen"></i>
                                </button>
                            .   <button class ="btn btn-danger btneliminar">
                                <i class="fa-solid fa-trash"></i>
                                </button>
                                `
                            }
                        }
                    ]
                });
            })


        </script>


<?php require_once "sectores/parte_inferior.php" ?>