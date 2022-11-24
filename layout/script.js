let abierto = false;

function abrir_login() {
  // const menu = document.getElementsByClassName("login");
  const container = document.getElementById("container");
  const abridor = document.getElementById("login");
  const header = document.getElementById("header");
  const navegador = document.getElementById("navegador");
  const footer = document.getElementById("footer");
  if (!abierto) {
    abridor.style.transform = "translateX(0vw)";
    container.style.transform = "translateX(-20vw)";
    navegador.style.transform = "translateX(-20vw)";
    header.style.transform = "translateX(-20vw)";
    footer.style.transform = "translateX(-20vw)";
    abierto = true;
    container.addEventListener("click", abrir_login);
  } else {
    abierto = false;
    container.removeEventListener("click", abrir_login);
    abridor.style.transform = "translateX(20vw)";
    container.style.transform = "translateX(0vw)";
    navegador.style.transform = "translateX(0vw)";
    header.style.transform = "translateX(0vw)";
    footer.style.transform = "translateX(0vw)";
  }
}

function mostrar() {
  const parrafo = document.getElementById("log_ok").textContent;
  if (parrafo == "Bienvenido! ") {
    const formulario = document.getElementById("formulario");
    formulario.style.display = "none";
  } else {
    const perfil = document.getElementById("perfil");
    perfil.style.display = "none";
  }
}

function desplegar() {
  const button = document.getElementById("botonSub");
  const container = document.getElementById("container");
  const footer = document.getElementById("footer");

  if (!abierto) {
    button.style.width = "5vw";
    button.style.fontSize = "1em";
    abierto = true;
    container.addEventListener("click", desplegar);
  } else {
    abierto = false;
    container.removeEventListener("click", desplegar);

    button.style.width = "0vw";
    button.style.fontSize = "0em";
  }
}

function mostrar_opciones_login() {
  let x = document.getElementsByClassName("texto_login");

  for (let i = 0; i <= x.length - 1; i++) {
    x[i].style.transform = "translateX(0)";
  }
}

