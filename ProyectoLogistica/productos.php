<?php require_once "sectores/parte_superior.php" ?>


        <h1>Productos</h1>
        <div class="btn-agregar-producto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal" >Agregar Producto</button>
        </div>
        <table id="productos" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id.Producto</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
        </table>
        <!-- MODAL -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div>
                        <form>
                            <div>
                                <input type="hidden" id="id_producto" name="id_producto">
                                <div class="mb-3">
                                    <label for="nombre">Nombre: </label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese el producto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion">Descripcion: </label>
                                    <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripcion del producto " required>
                                </div>
                                <div class="mb-3">
                                    <label for="stock">Stock: </label>
                                    <input type="number" id="stock" name="stock" placeholder="Ingrese el stock del producto " required>
                                </div>
                                <div class="mb-3">
                                    <label for="precio">Precio: </label>
                                    <input type="number" id="precio" name="precio" placeholder="Ingrese el Precio del producto " required>
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
                let tabla = new DataTable('#productos', {
                    dom: 'Bfrtip',
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    info:'false',
                    ordering:'false',
                    paging:'false',
                    ajax:{
                        url:'ajaxs/productos.ajax.php',
                        dataSrc:''
                    },
                    columns:[
                        {data: 'id_producto'},
                        {data:'nombre'},
                        {data:'descripcion'},
                        {data:'stock'},
                        {data:'precio'},
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
                $('.btn-agregar-productos').on('click',function(){
                    accion = "registrar";
                })
                $('#btnguardar').on('click',function(){
                    let id_producto = $("#id_producto").val(),
                        nombre = $("#nombre").val(),
                        descripcion = $("#descripcion").val(),
                        stock = $("#stock").val(),
                        precio = $("#precio").val()
                    let datos = new FormData();
                    datos.append('id_producto',id_producto);
                    datos.append('nombre',nombre);
                    datos.append('descripcion',descipcion);
                    datos.append('stock',stock);
                    datos.append('precio',precio);
                    datos.append('accion',accion);
                    if (nombre === '' || descripcion === '' || stock === '' || precio === '') {
                        alert('Por favor, completa todos los campos.');
                        return;
                    }
                    $.ajax({
                        url: "ajaxs/productos.ajax.php",
                        method: "POST",
                        data:datos,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                            console.log(respuesta);
                            document.activeElement.blur();
                            $("#miModal").modal('hide');
                            $('#productos').DataTable().ajax.reload();
                            $("#nombre").val(""),
                            $("#descripcion").val(""),
                            $("#stock").val(""),
                            $("#precio").val("");
                        }
                    })
                    
                })

                $('#productos, tbody').on('click','.btneditar',function(){

                })

                $('#productos, tbody').on('click','.btneliminar',function(){
                    
                })


            })

        </script>
<?php require_once "sectores/parte_inferior.php" ?>