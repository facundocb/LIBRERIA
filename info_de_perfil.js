let input_datos = document.querySelectorAll(".input_general"); //nodo de inputs
const mostrar_datos = () => {
  fetch("functions/c_cargar_info_user.php") //lo primero q hago es llamar al controlador q me carga la info
    .then(function (response) {
      if (response.ok) {
        return response.text();
        //si esta todo bien, q retorne, sino que tire error
      } else {
        throw "error";
      }
    })

    .then(function (respuesta_datos_user) {
      datos_user = new Array();
      datos_user = JSON.parse(respuesta_datos_user);

      //guarda en datos_user la respuesta del controlador

      if (datos_user["estado"] == 0) {
        //si por alguna razón llegara a fallar esto
        console.log("fatal error");
      } else {
        //sino q guarde los retornos en los inputs
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

//q se ejecute cuando cargue





let flag = 0;//es como abierto
let p = document.getElementById("pass"); // el p de contraseña
let edit_boton = document.getElementById('edit'); //el boton de editar


let datos_personales_cont = document.getElementById("datos_personales"); //el container de los datos
let botones_cont = document.getElementById("botones"); //el container de los botones

function cargar_botones() {

  let nuevo_div = document.createElement("div");
  let nuevo_p = document.createElement("p");
  let nuevo_input = document.createElement("input");
  let nuevo_cont_error = document.createElement("div");
  //crea un seccion nueva para el confirmar contraseña


  let cancelar_boton = document.createElement("button");
  let span_cancelar = document.createElement("span");
  //crea el boton de cancelar
  let done_boton = document.createElement("button");
  let span_done = document.createElement("span");
  //crea el boton de guardar

  span_cancelar.innerHTML = 'close';
  span_done.innerHTML = 'done'; 
  //les guarda los valores para q se carguen los iconos


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
    datos_personales_cont.appendChild(nuevo_div); //inserta un nuevo contenedor en el principal
    nuevo_div.appendChild(nuevo_p); 
    nuevo_div.appendChild(nuevo_input);
    //inserta en el nuevo contenedor el p y el input
    nuevo_p.innerHTML = "Confirmar clave:";
    datos_personales_cont.appendChild(nuevo_cont_error);


    botones_cont.appendChild(cancelar_boton);
    cancelar_boton.appendChild(span_cancelar); 
    botones_cont.appendChild(done_boton);
    done_boton.appendChild(span_done);
    
    //los botones guardan el icon

    edit_boton.remove();
    //se borra este
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
    //se borra todo y vuelve a surgir el de editar


  }
}

let alerta = document.getElementById('alerta');
function modificar_inputs() {

  if (!flag) {
    for (let i = 0; i < input_datos.length; i++) {

      if(i != 3){
        input_datos[i].disabled = false; //este es el de la ci, no se puede cambiar
      }
    }
    p.innerHTML = "Clave:";
    cargar_botones(); //que cargue lo q tenga q cargar
    mostrar_datos(); //que recargue la pagina
    alerta.innerHTML = ''; //se esconde la alerta
    flag = 1;
  } else {
    for (let i = 0; i < input_datos.length; i++) {
      input_datos[i].disabled = true; //se desactivan los inputs
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
  let datos = document.querySelectorAll('.input_general'); //tengo q declarar otra variable porque esta tiene el nuevo input.

  actualizar_user_data.set("nombre", datos[0].value);
  actualizar_user_data.set("apellido", datos[1].value);
  actualizar_user_data.set("localidad", datos[2].value);
  actualizar_user_data.set("fecha_nac", datos[4].value);
  actualizar_user_data.set("user", datos[5].value);
  actualizar_user_data.set("clave", datos[6].value);
  actualizar_user_data.set("conf_clave", datos[7].value);
  
  //guardo los datos en un formulario

    fetch("c_actualizar_info_de_perfil.php", {
      method:'POST',
      body: actualizar_user_data
      //le paso este formulario
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
      
      alerta.innerHTML = ''; //reinicio la alerta
      resultado = new Array(); 
      resultado = JSON.parse(respuesta_update); // guardo el JSON en un arr
      if(resultado['estado'] == 0){
        alerta.innerHTML = 
        "<div class='error'><p class='error_p'>No se pudo actualizar la información</p></div>" 


        for (const key in resultado) {
          if(key !='estado'){
             errors[key].innerHTML = 
             "<p class='error_p'> " + resultado[key] + "</p>";
             //si sale mal, muestra una alerta de error en cada input
          }
        }
      }else{
        location.reload();
        //si sale bien q se recargue la pagina.
      }
      

    })


}

