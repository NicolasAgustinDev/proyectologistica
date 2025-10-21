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
            url:'../ajaxs/productos.ajax.php',
            dataSrc:''
        },
        columns:[
            {data: 'id_producto'},
            {data:'producto'},
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

    $('.btn-agregar-producto').on('click',function(){
        accion = "registrar";
    })
    $('#btnguardar').on('click',function(){
        Swal.fire({
            title: "Confirmar ?",
            text: "Estas seguro que deseas registrar este Producto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, deseo registrar!",
            cancelButtonText: "No, cancelar!"
            }).then((result) => {
            if (result.isConfirmed) {
                let producto = $("#producto").val(),
                    descripcion = $("#descripcion").val(),
                    stock = $("#stock").val(),
                    precio = $("#precio").val(),
                    id_producto = $("#id_producto").val()
                var datos = new FormData();
                datos.append('id_producto',id_producto)
                datos.append('producto',producto);
                datos.append('descripcion',descripcion);
                datos.append('stock',stock);
                datos.append('precio',precio);
                datos.append('accion',accion);
                
                if (producto === '' || descripcion === '' || stock === ''|| precio === ''){
                    Swal.fire('Error, Por favor, completa todos los campos', 'error.');
                    return;
                }
                $.ajax({
                    url: "../ajaxs/productos.ajax.php",
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
                        Swal.fire('Éxito', 'Producto agregado correctamente', 'success');
                    }
                })
            }else{}
        })        
    })
    $('#productos, tbody').on('click','.btneditar',function(){
        let tabla = $('#productos').DataTable();
        let data =tabla.row($(this).parents('tr')).data();
        accion = "modificar";

        $("#id_producto").val(data["id_producto"]);
        $("#producto").val(data["producto"]);
        $("#descripcion").val(data["descripcion"]);
        $("#stock").val(data["stock"]);
        $("#precio").val(data["precio"]);
    })
    $('#productos, tbody').on('click','.btneliminar',function(){
        let tabla = $('#productos').DataTable();
        let data =tabla.row($(this).parents('tr')).data()
        let id_producto = data ['id_producto'];

        let datos = new FormData();
        datos.append('id_producto',id_producto);
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
                    url: "../ajaxs/productos.ajax.php",
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