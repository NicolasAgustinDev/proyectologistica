

addEventListener("DOMContentLoaded", ()=>{
    btnMapa.addEventListener("click",mostrarMapa);

});
function mostrarMapa(){
    const mapa = document.getElementById('mapaContenedor');
    mapa.style.display = mapa.style.display == 'none' ? 'block' : 'none';

}
//Si el mapa está oculto (display == "none"), lo cambia a "block" → lo muestra.
//Si está visible (no es "none"), lo cambia a "none" → lo oculta.




