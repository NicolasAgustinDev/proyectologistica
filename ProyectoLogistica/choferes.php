<?php require_once "sectores/parte_superior.php" ?>

        <h1>Choferes</h1>
        <div class="btn-agregar-chofer">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">Agregar Chofer</button>
        </div>
        <table id="choferes" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id.Chofer</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Licencia</th>
                </tr>
            </thead>
        </table>

        <!-- MODAL -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Chofer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div>
                        <form>
                            <div>
                                <input type="hidden" id="id_chofer" name="id_chofer">
                                <div class="mb-3">
                                    <label for="nombre">Nombre: </label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellido">Apellido: </label>
                                    <input type="text" id="apellido" name="apellido" placeholder="Ingrese el apellido" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono">Teléfono: </label>
                                    <input type="number" id="telefono" name="telefono" placeholder="Ingrese el teléfono " required>
                                </div>
                                <div class="mb-3">
                                    <label for="licencia">Licencia: </label>
                                    <input type="text" id="licencia" name="licencia" placeholder="Ingrese la licencia " required>
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
        <script>
            
            $(document).ready(function(){
                let accion = "";
                let tabla = new DataTable('#choferes', {
                    dom: 'Bfrtip',
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    info:'false',
                    ordering:'false',
                    paging:'false',
                    ajax:{
                        url:'ajaxs/choferes.ajax.php',
                        dataSrc:''
                    },
                    columns:[
                        {data: 'id_chofer'},
                        {data:'nombre'},
                        {data:'apellido'},
                        {data:'telefono'},
                        {data:'licencia'},
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
                    ],
                })
                $('.btn-agregar-chofer').on('click',function(){
                    accion = "registrar";
                })

                $('#choferes, tbody').on('click','.btneditar',function(){
                    let tabla = $('#choferes').DataTable();
                    let data =tabla.row($(this).parents('tr')).data();
                    accion = "modificar";

                    $("#id_chofer").val(data["id_chofer"]);
                    $("#nombre").val(data["nombre"]);
                    $("#apellido").val(data["apellido"]);
                    $("#telefono").val(data["telefono"]);
                    $("#licencia").val(data["licencia"]);
                })

                $('#choferes, tbody').on('click','.btneliminar',function(){
                    let tabla = $('#choferes').DataTable();
                    let data =tabla.row($(this).parents('tr')).data()
                    let id_chofer = data ['id_chofer'];

                    let datos = new FormData();
                    datos.append('id_chofer',id_chofer);
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
                                    url: "ajaxs/choferes.ajax.php",
                                    method: "POST",
                                    data:datos,
                                    cache:false,
                                    contentType: false,
                                    processData: false,
                                    success:function(respuesta){
                                        console.log(respuesta);
                                        $('#choferes').DataTable().ajax.reload();
                                    }
                                })
                        }else{
                        }
                    });
                })



                

                //Guardar la informacion desde la ventana modal
                $('#btnguardar').on('click',function(){
                    let nombre = $("#nombre").val(),
                        apellido = $("#apellido").val(),
                        telefono = $("#telefono").val(),
                        licencia = $("#licencia").val(),
                        id_chofer = $("#id_chofer").val()

                    let datos = new FormData();
                    datos.append('id_chofer',id_chofer);
                    datos.append('nombre',nombre);
                    datos.append('apellido',apellido);
                    datos.append('telefono',telefono);
                    datos.append('licencia',licencia);
                    datos.append('accion',accion);
                    if (nombre === '' || apellido === '' || telefono === '' || licencia === '') {
                        alert('Por favor, completa todos los campos.');
                        return;
                    }
                    $.ajax({
                        url: "ajaxs/choferes.ajax.php",
                        method: "POST",
                        data:datos,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                            console.log(respuesta);
                            document.activeElement.blur();
                            $("#miModal").modal('hide');
                            $('#choferes').DataTable().ajax.reload();
                            $("#nombre").val(""),
                            $("#apellido").val(""),
                            $("#telefono").val(""),
                            $("#licencia").val("");
                        }
                    })
                }) 
            })
        </script>

<?php require_once "sectores/parte_inferior.php" ?>