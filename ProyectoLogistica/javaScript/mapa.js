addEventListener("DOMContentLoaded", function () {
  const btnMapa = document.getElementById("btnMapa");
  const mapa = document.getElementById("mapaContenedor");

  btnMapa.addEventListener("click", function () {
    mapa.classList.toggle("d-none");
    if (!mapa.classList.contains("d-none")) {
      mapa.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  });
});









