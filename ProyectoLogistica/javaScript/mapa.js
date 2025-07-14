document.addEventListener("DOMContentLoaded", () => {
    const boton = document.getElementById("btnMostrarMapa");
    const mapa = document.getElementById("mapa");

    boton.addEventListener("click", () => {
      if (mapa.style.display === "none" || mapa.style.display === "") {
        mapa.style.display = "block";
        mapa.scrollIntoView({ behavior: "smooth" });
      } else {
        mapa.style.display = "none";
      }
    });
  });
