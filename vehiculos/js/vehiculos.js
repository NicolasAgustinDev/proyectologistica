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
            url:'../ajaxs/vehiculos.ajax.php',
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
                    url: "../ajaxs/vehiculos.ajax.php",
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
                let patente = $("#patente").val(),
                    tipo = $("#tipo").val(),
                    capacidad_kg = $("#capacida_kg").val(),
                    id_vehiculo = $("#id_vehiculo").val()
                var datos = new FormData();
                datos.append('id_vehiculo',id_vehiculo)
                datos.append('patente',patente);
                datos.append('tipo',tipo);
                datos.append('capacidad_kg',capacidad_kg);
                datos.append('accion',accion);
                
                if (patente === '' || tipo === '' || capacidad_kg === ''){
                    Swal.fire('Error, Por favor, completa todos los campos', 'error.');
                    return;
                }
                $.ajax({
                    url: "../ajaxs/vehiculos.ajax.php",
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
                        Swal.fire('Éxito', 'Vehiculo agregado correctamente', 'success');
                    }
                })
            }else{}
        })        
    })
})