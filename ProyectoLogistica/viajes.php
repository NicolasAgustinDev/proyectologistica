<<<<<<< HEAD
<?php require_once "sectores/parte_superior.php" ?>
        <h1></h1>
        <div>
                
        </div>
        
=======
<?php require_once "sectores/parte_superior.php"; ?>
<?php require_once "sectores/parte_inferior.php"; ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

<!-- FontAwesome -->
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<h1>Viajes</h1>
>>>>>>> c229db4e4b73d5bfc0ac83b773a74cf9f5be2980

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
        Agregar Viaje
    </button>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAsignar">
        Asignar Viaje
    </button>
</div>

<!-- Agregar Viaje -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="labelAgregar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="labelAgregar">Agregar Viaje</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <input type="hidden" id="id_viaje" name="id_viaje">

                    <div class="mb-3">
                        <label for="destino" class="form-label">Destino:</label>
                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Ingrese destino" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Chofer" required>
                    </div>
                     <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido: </label>
                        <input type="text" class="form-control" id=apellido" name="apellido" placeholder="Apellido del Chofer" required>
                    </div>

                    <div class="mb-3">
                        <label for="licencia" class="form-label">Licencia:</label>
                        <input type="text" class="form-control" id="licencia" name="licencia" placeholder="Ingrese la licencia" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarAgregar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Asignar Viaje -->
<div class="modal fade" id="modalAsignar" tabindex="-1" aria-labelledby="labelAsignar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="labelAsignar">Asignar Viaje</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <input type="hidden" id="id_viaje_asignar" name="id_viaje_asignar">

                    <div class="mb-3">
                        <label for="nombApelAsignar" class="form-label">Nombre y Apellido:</label>
                        <input type="text" class="form-control" id="nombApelAsignar" name="nombApelAsignar" placeholder="Ingrese nombre y apellido" required>
                    </div>

                    <div class="mb-3">
                        <label for="licenciaAsignar" class="form-label">Licencia:</label>
                        <input type="text" class="form-control" id="licenciaAsignar" name="licenciaAsignar" placeholder="Ingrese la licencia" required>
                    </div>

                    <div class="mb-3">
                        <label for="patente" class="form-label">Patente:</label>
                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Ingrese patente" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_salida" class="form-label">Fecha Salida:</label>
                        <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
                    </div>

                    <div class="mb-3">
                        <label for="destinoAsignar" class="form-label">Destino:</label>
                        <input type="text" class="form-control" id="destinoAsignar" name="destinoAsignar" placeholder="Ingrese el destino" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnGuardarAsignar">Guardar</button>
            </div>
        </div>
</div>
</div>

<script>
$(document).ready(function(){

    $("#btnGuardarAgregar").on("click", function(){

        let datos = {
            destino: $("#destino").val(),
            nombApel: $("#nombApel").val(),
            licencia: $("#licencia").val()
        };

        $.ajax({
            url: "ajax/viajes.ajax.php",
            method: "POST",
            data: datos,
            dataType: "json",
            success: function(respuesta){
                if(respuesta == "ok"){
                    alert("Viaje guardado correctamente ✅");
                    $("#modalAgregar").modal('hide');
                    location.reload();
                }else{
                    alert("Error al guardar ❌");
                }
            }
        });
    });

});
</script>


