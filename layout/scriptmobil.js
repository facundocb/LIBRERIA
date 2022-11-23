function abrir_menu() {
  const abridor = document.getElementById("login");
if (screen.width<=768){
  if (!abierto) {
    abridor.style.transform = "translateX(0vw)";
    abierto = true;
    container.addEventListener("click", abrir_menu);
  } else {
    abierto = false;
    container.removeEventListener("click", abrir_menu);
    abridor.style.transform = "translateX(100vw)";

  }
}}
// aa
function abririnput() {
  const container = document.getElementById("container");
  const inputmobil = document.getElementById("buscador");
  if (!abierto) {
    inputmobil.style.width = "45vw";
    inputmobil.style.height = "50%";
    inputmobil.style.backgroundColor = "var(--color-cuatro)";
    abierto = true;
    container.addEventListener("click", abririnput);
  } else {
    abierto = false;
    container.removeEventListener("click", abririnput);
    inputmobil.style.width = "0";
    inputmobil.style.height = "0";
    inputmobil.style.backgroundColor = "transparent";
  }
}
