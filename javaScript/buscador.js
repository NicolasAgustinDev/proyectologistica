addEventListener("DOMContentLoaded", () => {
    const btnBuscar = document.getElementById("btnBuscar");
    const inputBusqueda = document.getElementById("busquedaDireccion");
    const direccionTexto = document.querySelector(".direccion-texto");
    const mapaContenedor = document.getElementById("mapaContenedor");
    const iframe = mapaContenedor.querySelector("iframe");
    const btnComenzarRuta = document.getElementById("btnComenzarRuta");

    // arreglo (agregar a BD después)
    const visitas = [
        {
            orden: 1,
            direccion: "Centenario 281",
            codigo: "001",
            paquetes: 5,
            estado: "Pendiente"
        },
        {
            orden: 2,
            direccion: "LaMadrid 123",
            codigo: "002",
            paquetes: 3,
            estado: "Aceptado"
        },
        {
            orden: 3,
            direccion: "Alsina",
            codigo: "003",
            paquetes: 2,
            estado: "Rechazado"
        }
    ];

    let direccionSeleccionada = null;

    // Busca la dirección y la muestra en el mapa
    btnBuscar.addEventListener("click", () => {
        const direccion = inputBusqueda.value.trim();
        if (direccion === "") {
            alert("Por favor ingresa una dirección");
            return;
        }

        direccionSeleccionada = direccion;
        direccionTexto.textContent = "📍 " + direccion;

        mapaContenedor.style.display = "block";
        iframe.src = `https://www.google.com/maps?q=${encodeURIComponent(direccion)}&output=embed`;
    });

    // Comenzar ruta → abrir nueva ventana con info
    btnComenzarRuta.addEventListener("click", () => {
        if (!direccionSeleccionada) {
            alert("Primero buscá una dirección para comenzar la ruta.");
            return;
        }

        // búsqueda
        const visita = visitas.find(v =>
            v.direccion.trim().toLowerCase() === direccionSeleccionada.trim().toLowerCase()
        );

        if (!visita) {
            alert("No se encontraron datos para esa dirección.");
            return;
        }

        // nueva ventana
        const nuevaVentana = window.open("", "_blank", "width=600,height=500");
        nuevaVentana.document.title = `Ruta - ${visita.direccion}`;

        // Bootstrap
        const linkBootstrap = nuevaVentana.document.createElement("link");
        linkBootstrap.rel = "stylesheet";
        linkBootstrap.href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css";
        nuevaVentana.document.head.appendChild(linkBootstrap);

        // Contenido
        nuevaVentana.document.body.innerHTML = `
          <div class="container p-4">
            <h3><strong>Dirección:</strong> ${visita.direccion}</h3>
            <hr>
            <p><strong>N° de Orden:</strong> ${visita.orden}</p>
            <p><strong>Código:</strong> ${visita.codigo}</p>
            <p><strong>Total de Paquetes:</strong> ${visita.paquetes}</p>
            <p><strong>Estado:</strong> ${visita.estado}</p>

            <!-- Botones -->
            <div class="container text-center mt-4">
            <div class="row g-2">
            <div class="col-6">
            <button class="btn btn-danger w-100">Rechazar Ordenes</button>
            </div>
            <div class="col-6">
            <button class="btn btn-success w-100">Aceptar Ordenes</button>
            </div>
            </div>
            
            <div class="row g-2 mt-2">
            <div class="col-4">
            <button class="btn btn-primary w-100">Foto</button>
            </div>
            <div class="col-4">
            <button class="btn btn-primary w-100">Firma</button>
            </div>
            <div class="col-4">
            <button class="btn btn-primary w-100">Comentario</button>
            </div>
            </div>

            <div class="row mt-3">
            <div class="col-12">
            <button id="btnCerrarDireccion" class="btn btn-dark w-100">Cerrar Dirección</button>
            </div>
            </div>
            </div>
            </div>
        `;

        // cerrar
     nuevaVentana.document.getElementById("btnCerrarDireccion").addEventListener("click", () => {
            nuevaVentana.close();
        });

    });
});


