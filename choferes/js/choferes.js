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
            url:'../ajaxs/choferes.ajax.php',
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

    $('#btnguardar').on('click',function(){
        Swal.fire({
            title: "Confirmar ?",
            text: "Estas seguro que deseas registrar este Chofer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, deseo registrar!",
            cancelButtonText: "No, cancelar!"
            }).then((result) => {
            if (result.isConfirmed) {
                let id_chofer = $("#id_chofer").val(),
                    apellido = $("#apellido").val(),
                    nombre = $("#nombre").val(),
                    licencia = $("#licencia").val(),
                    telefono = $("#telefono").val()
                var datos = new FormData();
                datos.append('id_chofer',id_chofer)
                datos.append('apellido',apellido);
                datos.append('nombre',nombre);
                datos.append('licencia',licencia);
                datos.append('telefono',telefono);
                datos.append('accion',accion);
                
                if (nombre === '' || apellido === '' || telefono === '' || licencia ===''){
                    Swal.fire('Error, Por favor, completa todos los campos', 'error.');
                    return;
                }
                $.ajax({
                    url: "../ajaxs/choferes.ajax.php",
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
                        Swal.fire('Éxito', 'Chofer agregado correctamente', 'success');
                    }
                })
            }else{}
        })        
    })

    $('#choferes, tbody').on('click','.btneditar',function(){
        let data =tabla.row($(this).parents('tr')).data();
        accion = "modificar";

        $("#id_chofer").val(data["id_chofer"]);
        $("#nombre").val(data["nombre"]);
        $("#apellido").val(data["apellido"]);
        $("#telefono").val(data["telefono"]);
        $("#licencia").val(data["licencia"]);
    })
    $('#choferes, tbody').on('click','.btneliminar',function(){
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
                    url: "../ajaxs/choferes.ajax.php",
                    method: "POST",
                    data:datos,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(respuesta){
                        console.log(respuesta);
                        tabla.ajax.reload();
                        Swal.fire('Éxito', 'Chofer eliminado correctamente', 'success');
                    }
                })
            }else{}
        });
    })
})
