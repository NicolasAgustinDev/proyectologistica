$(document).ready(function(){
    accion="";
    let tablapedidos = new DataTable('#pedidos', {
        dom: 'Bfrtip',
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        },
        info:'false',
        ordering:'false',
        paging:'false',
        ajax:{
            url:'../ajaxs/viajes.ajax.php',
            type: 'GET',
            dataSrc:''
        },
        columns:[
            {data:'id_pedido'},
            {data:'nombre'},
            {data:'producto'},
            {data:'cantidad'},
            { data: 'direccion', visible: false },
            { data: 'precio', visible: false },
            { data: 'total', visible: false },
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
    let tablaviajes = new DataTable('#viajes', {
        ordering: false,
        info: false,
        searching: false,
        columns :[
            { data: 'id_pedido', visible: false },
            { data: 'producto' },
            {
                data: 'cantidad',
            },
            {
                data: 'precio',
            },
            {
                data: 'total',
            },
            {
                data: 'direccion',
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


    $('#pedidos tbody').on('click','.btnagregar',function(){
        //Obtener datos de la fila cliqueada
        let pedidos = tablapedidos.row($(this).parents('tr')).data();
        let existe = false;

        tablaviajes.rows().every(function(){
            let rowData = this.data();
            if(parseInt(rowData.id_pedido) === parseInt(pedidos.id_pedido)){
                existe = true;
                return false; // 🔹 rompe el bucle (equivale a "break")
            }
        })
        // Si ya existe, mostrar alerta y salir
        if (existe) {
            Swal.fire({
                icon: 'info',
                title: 'Pedido ya agregado',
                text: `El pedido #${pedidos.id_pedido} ya fue agregado.`,
                timer: 2000,
                showConfirmButton: false
            });
            return; // 🔹 detiene la función
        }
        //Si no existe lo agregamos
        tablaviajes.row.add({
            id_pedido: pedidos.id_pedido,
            producto: pedidos.producto,
            cantidad: pedidos.cantidad,
            precio: pedidos.precio,
            total: pedidos.total,
            direccion: pedidos.direccion
        }).draw(false);

        Swal.fire({
            icon: 'success',
            title: 'Agregado correctamente',
            text: `El pedido #${pedidos.id_pedido} fue agregado a viajes.`,
            timer: 1500,
            showConfirmButton: false
        });
    });

    $('#viajes tbody').on('click','.btneliminar',function(){
        tablaviajes.row($(this).parents('tr')).remove().draw();
    })
    cargarRutas();
    function cargarRutas(){
        $.ajax({
            url: '../ajaxs/rutas.ajax.php',
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
                alert('Error al cargar las rutas.');
            }
        });
    }

    cargarVehiculos();
    function cargarVehiculos(){
        $.ajax({
            url: '../ajaxs/vehiculos.ajax.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let opciones = '<option value="">Seleccione un Vehiculo</option>';
                data.forEach(function(vehiculos){
                    opciones += `<option value="${vehiculos.id_vehiculo}">${vehiculos.tipo}</option>`;
                });
                $('#id_vehiculo').html(opciones);
            },
            error: function() {
                console.error('Error al cargar los vehiculos:', error);
                alert('Error al cargar los vehiculos.');
            }
        });
    }
    cargarChoferes();
    function cargarChoferes(){
        $.ajax({
            url: '../ajaxs/choferes.ajax.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let opciones = '<option value="">Seleccione un Chofer</option>';
                data.forEach(function(vehiculos){
                    opciones += `<option value="${vehiculos.id_chofer}">${vehiculos.nombre} ${vehiculos.apellido}</option>`;
                });
                $('#id_chofer').html(opciones);
            },
            error: function() {
                console.error('Error al cargar los choferes:', error);
                alert('Error al cargar los choferes.');
            }
        });
    }
});