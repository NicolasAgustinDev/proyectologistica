$(document).ready(function(){
    accion="";
    let tabla = new DataTable('#pedidos', {
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