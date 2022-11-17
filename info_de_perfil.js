let input_datos = document.querySelectorAll(".input_general");
const mostrar_datos = () => {
  fetch("functions/c_cargar_info_user.php")
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_datos_user) {
      datos_user = new Array();
      datos_user = JSON.parse(respuesta_datos_user);

      if (datos_user["estado"] == 0) {
        console.log("fatal error");
      } else {
        input_datos[0].value = datos_user["nom"];
        input_datos[1].value = datos_user["ape"];
        input_datos[2].value = datos_user["loc"];
        input_datos[3].value = datos_user["ci"];
        input_datos[4].value = datos_user["nac"];
        input_datos[5].value = datos_user["usr"];
      }
    });
};

window.onload = mostrar_datos;

let flag = 0;
let p = document.getElementById("pass");
let datos_personales_cont = document.getElementById("datos_personales");

function mostrar_nueva_pass() {
  let nuevo_div = document.createElement("div");
  let nuevo_p = document.createElement("p");
  let nuevo_input = document.createElement("input");

  nuevo_div.classList.add("content");
  nuevo_div.setAttribute("id", "new_pass");
  nuevo_p.classList.add("subtitulo");
  nuevo_input.classList.add("input_general");

  if (!flag) {
    datos_personales_cont.appendChild(nuevo_div);
    nuevo_div.appendChild(nuevo_p);
    nuevo_div.appendChild(nuevo_input);
    nuevo_p.innerHTML = "Nueva Clave:";
  } else {
    let new_pass = document.getElementById("new_pass");
    new_pass.remove();
  }
}

function modificar_datos() {
  if (!flag) {
    for (let i = 0; i < input_datos.length; i++) {
      input_datos[i].disabled = false;
    }
    p.innerHTML = "Clave vieja:";
    mostrar_nueva_pass();

    flag = 1;
  } else {
    for (let i = 0; i < input_datos.length; i++) {
      input_datos[i].disabled = true;
    }
    p.innerHTML = "Clave:";
    mostrar_nueva_pass();
    flag = 0;
  }
}
