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
let edit_boton = document.getElementById('edit');

let datos_personales_cont = document.getElementById("datos_personales");
let botones_cont = document.getElementById("botones");
function cargar_botones() {
  let nuevo_div = document.createElement("div");
  let nuevo_p = document.createElement("p");
  let nuevo_input = document.createElement("input");
  let nuevo_cont_error = document.createElement("div");
  let cancelar_boton = document.createElement("button");
  let span_cancelar = document.createElement("span");
  let done_boton = document.createElement("button");
  let span_done = document.createElement("span");
  span_cancelar.innerHTML = 'close';
  span_done.innerHTML = 'done';

  nuevo_div.classList.add("content");
  nuevo_div.setAttribute("id", "new_pass");

  nuevo_p.classList.add("subtitulo");
  nuevo_input.classList.add("input_general");

  nuevo_cont_error.classList.add("error_upd");
  nuevo_cont_error.setAttribute('id', 'new_error');

  cancelar_boton.setAttribute('id','cancel');
  span_cancelar.classList.add('material-icons');
  cancelar_boton.setAttribute('onclick' , 'modificar_inputs()');


  done_boton.setAttribute('id', 'done');
  span_done.classList.add('material-icons');
  done_boton.setAttribute('onclick', 'actualizar_user()');

  
  if (!flag) {
    datos_personales_cont.appendChild(nuevo_div);
    nuevo_div.appendChild(nuevo_p);
    nuevo_div.appendChild(nuevo_input);
    nuevo_p.innerHTML = "Confirmar clave:";
    datos_personales_cont.appendChild(nuevo_cont_error);


    cancelar_boton.appendChild(span_cancelar);

    botones_cont.appendChild(cancelar_boton);

    done_boton.appendChild(span_done);
    botones_cont.appendChild(done_boton);
    edit_boton.remove();
    
  } else {
    let new_pass = document.getElementById("new_pass");
    let cancel = document.getElementById('cancel');
    let done = document.getElementById('done');
    let new_error = document.getElementById("new_error")
    new_pass.remove();
    cancel.remove();
    done.remove();  
    new_error.remove();
    botones_cont.appendChild(edit_boton);



  }
}

let alerta = document.getElementById('alerta');
function modificar_inputs() {
  if (!flag) {
    for (let i = 0; i < input_datos.length; i++) {

      if(i != 3){
        input_datos[i].disabled = false;
      }
    }
    p.innerHTML = "Clave:";
    cargar_botones();
    mostrar_datos();
    alerta.innerHTML = '';
    flag = 1;
  } else {
    for (let i = 0; i < input_datos.length; i++) {
      input_datos[i].disabled = true;
    }
    p.innerHTML = "Clave:";
    cargar_botones();
    mostrar_datos();
    flag = 0; 
    alerta.innerHTML = '';
  }
}




const actualizar_user = () =>{
  actualizar_user_data = new FormData();
  let datos = document.querySelectorAll('.input_general');

  actualizar_user_data.set("nombre", datos[0].value);
  actualizar_user_data.set("apellido", datos[1].value);
  actualizar_user_data.set("localidad", datos[2].value);
  actualizar_user_data.set("fecha_nac", datos[4].value);
  actualizar_user_data.set("user", datos[5].value);
  actualizar_user_data.set("clave", datos[6].value);
  actualizar_user_data.set("conf_clave", datos[7].value);
  console.log(actualizar_user_data.get('fecha_nac'));
    fetch("c_actualizar_info_de_perfil.php", {
      method:'POST',
      body: actualizar_user_data
    })
    .then(function(response){
      if(response.ok){
        return response.text();
      }else{
        throw "Error";
      }
    })
    .then(function(respuesta_update){
      let errors = document.getElementsByClassName('error_upd');
      
      alerta.innerHTML = '';
      resultado = new Array();
      resultado = JSON.parse(respuesta_update);
      if(resultado['estado'] == 0){
        alerta.innerHTML = 
        "<div class='error'><p class='error_p'>No se pudo actualizar la información</p></div>" 


        for (const key in resultado) {
          if(key !='estado'){
             errors[key].innerHTML = 
             "<p class='error_p'> " + resultado[key] + "</p>";
          }
        }
      }else{
        location.reload();
      }
      

    })


}

