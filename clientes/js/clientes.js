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
            url:'../ajaxs/clientes.ajax.php',
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
                alert('Error al cargar los puestos.');
            }
        });
    }
    $('.btn-agregar-cliente').on('click',function(){
        accion = "registrar";
    })
    $('#clientes, tbody').on('click','.btneditar',function(){
        //let tabla = $('#clientes').DataTable();
        let data =tabla.row($(this).parents('tr')).data();
        accion = "modificar";

        $("#id_cliente").val(data["id_cliente"]);
        $("#nombre").val(data["nombre"]);
        $("#direccion").val(data["direccion"]);
        $("#telefono").val(data["telefono"]);
        $("#id_ruta").val(data["id_ruta"]);
    })
    $('#clientes, tbody').on('click','.btneliminar',function(){
        let data = tabla.row($(this).parents('tr')).data()
        let id_cliente = data ['id_cliente'];

        let datos = new FormData();
        datos.append('id_cliente',id_cliente);
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
                    url: "../ajaxs/clientes.ajax.php",
                    method: "POST",
                    data:datos,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(respuesta){
                        console.log(respuesta);
                        tabla.ajax.reload();
                        Swal.fire('Éxito', 'Cliente eliminado correctamente', 'success');
                    }
                })
            }else{}
        });
    })

    $('#btnguardar').on('click',function(){
        Swal.fire({
            title: "Confirmar ?",
            text: "Estas seguro que deseas registrar este Cliente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, deseo registrar!",
            cancelButtonText: "No, cancelar!"
            }).then((result) => {
            if (result.isConfirmed) {
                let id_cliente = $("#id_cliente").val(),
                    id_ruta = $("#id_ruta").val(),
                    nombre = $("#nombre").val(),
                    direccion = $("#direccion").val(),
                    telefono = $("#telefono").val()
                var datos = new FormData();
                datos.append('id_cliente',id_cliente)
                datos.append('id_ruta',id_ruta);
                datos.append('nombre',nombre);
                datos.append('direccion',direccion);
                datos.append('telefono',telefono);
                datos.append('accion',accion);
                
                if (nombre === '' || direccion === '' || telefono === '' || id_ruta ===''){
                    Swal.fire('Error, Por favor, completa todos los campos', 'error.');
                    return;
                }
                $.ajax({
                    url: "../ajaxs/clientes.ajax.php",
                    method: "POST",
                    data:datos,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(respuesta){
                        console.log(respuesta);
                        // cerrar modal
                        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('miModal'));
                        modal.hide();
                        // limpiar backdrop gris "atascado"
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').removeAttr('style');
                        // refrescar tabla
                        tabla.ajax.reload();
                        // limpiar formulario
                        $('#miModal form')[0].reset();
                        Swal.fire('Éxito', 'Cliente agregado correctamente', 'success');
                    }
                })
            }else{}
        })        
    })
})