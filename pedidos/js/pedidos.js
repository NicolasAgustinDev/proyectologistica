$(document).ready(function() {
    $.ajax({
        url: '../ajaxs/clientes.ajax.php',
        method: 'GET',
        dataType: 'json',
        success: function(data){
            const select = $('#id_cliente');
            select.append('<option value="">Seleccione un Cliente</option>');
            data.forEach(function (clientes) {
                select.append(`<option value="${clientes.id_cliente}">${clientes.nombre} </option>`);
                console.log($("#id_cliente").val());
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
            url:'../ajaxs/productos.ajax.php',
            dataSrc:''
        },
        columns:[
            {data:'id_producto'},
            {data:'producto'},
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
            { data: 'producto' },
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
            if(rowData.producto === producto.producto){
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
                id_producto: producto.id_producto,
                producto: producto.producto,
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
            fecha_pedido = $("#fecha_pedido").val() ,
            total = $("#TotalGeneral").val()
        var datos = new FormData();
        datos.append('id_cliente',id_cliente);
        datos.append('fecha_pedido',fecha_pedido);
        datos.append('total',total);
        datos.append('detalles',JSON.stringify(detalles));
        if (id_cliente === '' || fecha_pedido  === '' || total  === '' || total == 0){
            alert('Por favor, completa todos los campos.');
            return;
        }
        console.log(fecha_pedido);
        $.ajax({
            url: "../ajaxs/pedidos.ajax.php",
            method: "POST",
            data:datos,
            cache:false,
            contentType: false,
            processData: false,
            success:function(id_pedido){
                console.log("Respuesta cruda del PHP:", id_pedido);
                id_pedido = JSON.parse(id_pedido);
                let totalDetalles = tablapedidos.rows().count();
                let detallesGuardados = 0;
                tablapedidos.rows().every(function(){
                    let row = this.data();
                    let detalle = new FormData();
                    detalle.append("id_pedido",id_pedido);
                    detalle.append("id_producto",row.id_producto);
                    detalle.append("cantidad",row.cantidad);
                    detalle.append("precio_unitario",row.precio);
                    detalle.append("subtotal",row.subtotal);
                    $.ajax({
                        url: "../ajaxs/pedidos.ajax.php?detalle=1",
                        method: "POST",
                        data: detalle,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success :function(respuesta){
                            detallesGuardados++;
                            if(detallesGuardados===totalDetalles){
                                console.log(id_pedido);
                                let form = $('<form>',{
                                    action :'remito.php',
                                    method:'POST',
                                    target:'_blank',
                                }).append($('<input>',{
                                    type: 'hidden',
                                    name: 'id_pedido',
                                    value:id_pedido
                                }));
                                $('body').append(form);
                                form.submit();
                                form.remove();
                            }
                        }
                    })
                })
                $("#id_cliente").val(""),
                $("#fecha_pedido").val(""),
                console.log($("#TotalGeneral").val(""));
                $("#TotalGeneralMostrar").text("0");
                tablapedidos.clear().draw();
            }
        })
    })
})