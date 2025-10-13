<?php require_once( "sectores/parte_superior.php"); ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

<!-- FontAwesome -->
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<h1>Gestión de Viajes</h1>

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
                <h5 class="modal-title" id="labelAgregar">Agregar Viaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formAgregarViaje">
                    <div class="mb-3">
                        <label for="destino" class="form-label">Destino:</label>
                        <input type="text" class="form-control" id="destino" required>
                    </div>

                    <div class="mb-3">
                        <label for="carga" class="form-label">Detalles de la Carga</label>
                        <label for="carga" class="form-label">(Tipo de mercaderia,Volumen, Peso, Cantidad) : </label>
                        <input type="text" class="form-control" id="carga" required>
                    </div>

                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente:</label>
                        <input type="text" class="form-control" id="cliente" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_salida" class="form-label">Fecha de Salida:</label>
                        <input type="date" class="form-control" id="fecha_salida" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" id="btnGuardarAgregar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Asignar Viaje -->
<div class="modal fade" id="modalAsignar" tabindex="-1" aria-labelledby="labelAsignar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="labelAsignar">Asignar Viaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formAsignarViaje">
                    <div class="mb-3">
                        <label for="id_viaje" class="form-label">ID del Viaje:</label>
                        <input type="number" class="form-control" id="id_viaje" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre_chofer" class="form-label">Nombre del Chofer:</label>
                        <input type="text" class="form-control" id="nombre_chofer" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido_chofer" class="form-label">Apellido del Chofer:</label>
                        <input type="text" class="form-control" id="apellido_chofer" required>
                    </div>

                    <div class="mb-3">
                        <label for="licencia" class="form-label">Licencia:</label>
                        <input type="text" class="form-control" id="licencia" required>
                    </div>

                    <div class="mb-3">
                        <label for="patente" class="form-label">Patente:</label>
                        <input type="text" class="form-control" id="patente" required>
                    </div>
                     <div class="mb-3">
                        <label for="fecha_asignada" class="form-label">Fecha de Asignada:</label>
                        <input type="date" class="form-control" id="fecha_asignada" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-success" id="btnGuardarAsignar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script principal -->
<script>
$(document).ready(function(){

    // Guardar nuevo viaje
    $("#btnGuardarAgregar").on("click", function(){
        let datos = {
            destino: $("#destino").val(),
            carga: $("#carga").val(),
            cliente: $("#cliente").val(),
            fecha_salida: $("#fecha_salida").val()
        };

        $.ajax({
            url: "ajaxs/viajes.ajaxs.php",
            method: "POST",
            data: datos,
            dataType: "json",
            success: function(respuesta){
                if(respuesta === "ok"){
                    alert("✅ Viaje agregado correctamente");
                    $("#modalAgregar").modal('hide');
                    location.reload();
                } else {
                    alert("❌ Error al guardar el viaje");
                }
            }
        });
    });

    // Guardar asignación
    $("#btnGuardarAsignar").on("click", function(){
        
        let datos = {
            id_viaje: $("#id_viaje").val(),
            nombre: $("#nombre_chofer").val(),
            apellido: $("#apellido_chofer").val(),
            licencia: $("#licencia").val(),
            patente: $("#patente").val(),
            fecha_asignada: $("#fecha_asignada").val()
        };
         console.log("📦 Enviando datos:", datos); // 🔍 Ver qué se envía

        $.ajax({
            url: "ajaxs/asignaciones.ajaxs.php",
            method: "POST",
            data: datos,
            dataType: "json",
            success: function(respuesta){
                if(respuesta === "ok"){
                    alert("✅ Asignación registrada correctamente");
                    $("#modalAsignar").modal('hide');
                    location.reload();
                } else {
                    alert("❌ Error al asignar el viaje");
                }
            },
             error: function(xhr, status, error){
            console.error("🚨 Error AJAX:", status, error);
            alert("Error al conectar con el servidor");
        }
        });
    });

});
</script>

<?php require_once "sectores/parte_inferior.php"; ?>
