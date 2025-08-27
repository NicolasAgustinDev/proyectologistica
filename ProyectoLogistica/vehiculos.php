<?php require_once "sectores/parte_superior.php" ?>

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
        <script>
            $(document).ready(function(){
                let accion = "";
                let tabla = new DataTable('#vehiculos', {
                    dom: 'Bfrtip',
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    info:'false',
                    ordering:'false',
                    paging:'false',
                    ajax:{
                        url:'ajaxs/vehiculos.ajax.php',
                        dataSrc:''
                    },
                    columns:[
                        {data: 'id_vehiculo'},
                        {data:'patente'},
                        {data:'tipo'},
                        {data:'capacidad_kg'},
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
                $('.btn-agregar-vehiculos').on('click',function(){
                    accion = "registrar";
                })
                
                $('#vehiculos, tbody').on('click','.btneliminar',function(){
                    let tabla = $('#vehiculos').DataTable();
                    let data =tabla.row($(this).parents('tr')).data();
                    let id_vehiculo = data ['id_vehiculo'];

                    let datos = new FormData();
                    datos.append('id_vehiculo',id_vehiculo);
                    datos.append('accion','eliminar');

                    Swal.fire({
                        title: "Confirmacion?",
                        text: "Estas seguro que deseas eliminar este Chofer!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si",
                        cancelButtonText: "No, cancelar!"
                        }).then((result) => {
                        if (result.isConfirmed) {
                                $.ajax({
                                    url: "ajaxs/vehiculos.ajax.php",
                                    method: "POST",
                                    data:datos,
                                    cache:false,
                                    contentType: false,
                                    processData: false,
                                    success:function(respuesta){
                                        console.log(respuesta);
                                        $('#vehiculos').DataTable().ajax.reload();
                                    }
                                })
                        }else{
                        }
                    });
                })

                $('#vehiculos, tbody').on('click','.btneditar',function(){
                    let tabla = $('#vehiculos').DataTable();
                    let data =tabla.row($(this).parents('tr')).data();
                    accion = "modificar";

                    $("#id_vehiculo").val(data["id_vehiculo"]);
                    $("#patente").val(data["patente"]);
                    $("#tipo").val(data["tipo"]);
                    $("#capacidad_kg").val(data["capacidad_kg"]);
                })

                $('#btnguardar').on('click',function(){
                    let patente = $("#patente").val(),
                        tipo = $("#tipo").val(), 
                        capacidad_kg = $("#capacidad_kg").val(),
                        id_vehiculo = $("#id_vehiculo").val()

                    let datos = new FormData();
                    datos.append('patente',patente);
                    datos.append('tipo',tipo);
                    datos.append('capacidad_kg',capacidad_kg);
                    datos.append('id_vehiculo',id_vehiculo);
                    datos.append('accion',accion);

                    if (patente === '' || tipo === '' || capacidad_kg === '') {
                        alert('Por favor, completa todos los campos.');
                        return;
                    }
                    $.ajax({
                        url: "ajaxs/vehiculos.ajax.php",
                        method: "POST",
                        data:datos,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                            console.log(respuesta);
                            document.activeElement.blur();
                            $("#miModal").modal('hide');
                            $('#vehiculos').DataTable().ajax.reload();
                            $("#patente").val(""),
                            $("#tipo").val(""),
                            $("#capacidad_kg").val("");
                        }
                    })
                })
            })


            
        </script>

<?php require_once "sectores/parte_inferior.php" ?>