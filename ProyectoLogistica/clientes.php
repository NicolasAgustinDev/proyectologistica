<?php require_once "sectores/parte_superior.php" ?>


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
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Data tables -->
        <script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
        <!-- Fontawesome -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                let accion = "";
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
                        {data:'ruta'},
                        {
                            data:null,
                            render:function(data,type,row){
                                return `<button class="btn btn-principal btneditar" data-bs-target="#miModal" data-bs-toggle="modal">
                                <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class ="btn btn-danger btneliminar">
                                <i class="fa-solid fa-trash"></i>
                                </button>
                                `
                            }
                        }
                    ]
                });
                $('#miModal').on('shown.bs.modal',function(){
                cargarRutas();
                })
                function cargarRutas(){
                    $.ajax({
                        url: 'ajaxs/rutas.ajax.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let opciones = '<option value="">Seleccione un ruta</option>';
                            data.forEach(function(rutas){
                                opciones += `<option value="${rutas.id_ruta}">${rutas.ruta}</option>`;
                            });
                            $('#id_ruta').html(opciones);
                        },
                        error: function() {
                            console.error('Error al cargar las rutas:', error);
                            alert('Error al cargar los puestos.');
                        }
                    });
                }
                $('.btn-agregar-cliente').on('click',function(){
                    accion = "registrar";
                })
                $('#btnguardar').on('click',function(){
                    let nombre = $("#nombre").val(),
                        direccion = $("#direccion").val(),
                        telefono = $("#telefono").val(),
                        id_ruta = $("#id_ruta").val(),
                        id_cliente = $("#id_cliente").val()

                    let datos = new FormData;
                    datos.append('id_cliente',id_cliente);
                    datos.append('nombre',nombre);
                    datos.append('direccion',direccion);
                    datos.append('telefono',telefono);
                    datos.append('id_ruta',id_ruta);
                    datos.append('accion',accion);
                    if (nombre === '' || direccion === '' || telefono === '' || id_ruta === '') {
                        alert('Por favor, completa todos los campos.');
                        return;
                    }
                    $.ajax({
                        url: "ajaxs/clientes.ajax.php",
                        method: "POST",
                        data:datos,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                            console.log(respuesta);
                            document.activeElement.blur();
                            $("#miModal").modal('hide');
                            $('#clientes').DataTable().ajax.reload();
                            $("#nombre").val("");
                            $("#direccion").val(""),
                            $("#telefono").val(""),
                            $("#id_ruta").val("");
                        }
                    })

                    

                    
                })
                
            })


        </script>
<?php require_once "sectores/parte_inferior.php" ?>