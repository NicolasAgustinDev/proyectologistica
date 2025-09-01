<?php require_once "sectores/parte_superior.php" ?>
        <h1>Pedidos</h1>
        <div>
            <label for="id_cliente">Cliente</label>
            <select id="id_cliente" name="id_cliente" class="form-control" required></select>
        </div>
        <div>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" placeholder="Ingrese una fecha" required>
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
                                <th>Nombre</th>
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
            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
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
        <script>

            $(document).ready(function() {
                $.ajax({
                url: 'ajaxs/clientes.ajax.php',
                method: 'GET',
                dataType: 'json',
                    success: function(data){
                        const select = $('#id_cliente');
                        select.append('<option value="">Seleccione un Cliente</option>');
                        data.forEach(function (clientes) {
                            select.append(`<option value="${clientes.id_cliente}">${clientes.nombre} </option>`);
                            console.log($("#id_clientes").val());
                        });
                    }
                })

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
                                return `<button class="btn btn-principal btnagregar">
                                <i class="fa-solid fa-plus"></i>
                                </button>
                                `
                            }
                        }
                    ]
                });

                let tablapedidos = new DataTable('#pedidos', {
                    ordering: false,
                    info: false,
                    searching: false,
                    columns :[
                        { data: 'nombre' },
                        {
                        data: 'cantidad',
                            render: function(data){
                                return `<input type="number" class="form-control cantidad-input"
                                value="${data}" min="1" style="width:80px;">`;
                            }
                        },
                        {
                        data: 'precio',
                            render: function(data){
                                return parseInt(data).toLocaleString('es-CL');
                            }
                        },
                        {
                        data: 'subtotal',
                            render: function(data){
                                return parseInt(data).toLocaleString('es-CL');
                            }
                        },
                        {
                        data:null,
                            render:function(data,type,row){
                                return `<button class="btn btn-danger btneliminar">
                                <i class="fa-solid fa-trash"></i>                            
                                </button>`
                            }
                        }
                    ]
                });
                $('#productos tbody').on('click','.btnagregar',function(){
                    //Obtener datos de la fila cliqueada
                    let producto = tabla.row($(this).parents('tr')).data();
                    let encontrado = false;

                    tablapedidos.rows().every(function(){
                        let rowData = this.data();
                        if(rowData.nombre === producto.nombre){
                            rowData.cantidad++;
                            rowData.subtotal = rowData.cantidad * rowData.precio;
                            this.data(rowData);

                            // Actualiza subtotal manualmente
                            let fila = $(this.node());
                            fila.find('td').eq(3).text(rowData.subtotal.toLocaleString('es-CL'));
                            // También actualiza el valor del input
                            fila.find('.cantidad-input').val(rowData.cantidad);
                            encontrado = true;
                            recalculartotal();
                        }
                    })
                    //Si no existe lo agregamos
                    if(!encontrado){
                        tablapedidos.row.add({
                            id: producto.id_producto,
                            nombre: producto.nombre,
                            cantidad: 1,
                            precio: producto.precio,
                            subtotal: producto.precio
                        }).draw();
                        recalculartotal();
                    }
                })

                $('#pedidos tbody').on('click','.btneliminar',function(){
                    tablapedidos.row($(this).parents('tr')).remove().draw();
                    recalculartotal();
                })

                $('#pedidos tbody').on('input','.cantidad-input',function(){
                    let fila = $(this).closest('tr');
                    let rowData = tablapedidos.row(fila).data();

                    let nuevaCantidad = parseInt($(this).val()) ;

                    rowData.cantidad = nuevaCantidad;
                    rowData.subtotal = rowData.precio * nuevaCantidad;

                    // Actualizar solo la columna del subtotal
                    fila.find('td').eq(3).text(rowData.subtotal.toLocaleString('es-CL'));
                    recalculartotal();
                })

                function recalculartotal(){
                    let total = 0;
                    tablapedidos.rows().every(function(){
                        let data = this.data();
                        let subtotal = parseFloat(data.subtotal);
                        if(!isNaN(subtotal)){
                            total += subtotal;
                        }
                    });
                    $('#TotalGeneralMostrar').text(total.toLocaleString('es-CL'));
                    $('#TotalGeneral').val(total);
                }

                let detalles = [];
                $('#guardar').on('click',function(){
                    let id_cliente = $("#id_cliente").val() ,
                        fecha = $("#fecha").val() ,
                        total = $("#TotalGeneral").val()

                    var datos = new FormData();
                    datos.append('id_cliente',id_cliente);
                    datos.append('fecha',fecha);
                    datos.append('total',total);
                    datos.append('detalles',JSON.stringify(detalles));
                    if (id_cliente === '' || fecha  === '' || total  === '' || total == 0){
                        alert('Por favor, completa todos los campos.');
                        return;
                    }
                    $.ajax({
                        url: "ajax/pedidos.ajax.php",
                        method: "POST",
                        data:datos,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(id_cliente){
                            id_cliente = JSON.parse(id_cliente);
                            let totalDetalles = tablapedidos.rows().count();
                            let detallesGuardados = 0;
                            tablapedidos.rows().every(function(){
                                let row = this.data();
                                let detalle = new FormData();
                                detalle.append("id_cliente",id_cliente);
                                detalle.append("id_producto",row.id);
                                detalle.append("cantidad",row.cantidad);
                                detalle.append("precio_unitario",row.precio);
                                detalle.append("subtotal",row.subtotal);

                            })

                        }
                    })
                })

            })
            
        </script>

<?php require_once "sectores/parte_inferior.php" ?>