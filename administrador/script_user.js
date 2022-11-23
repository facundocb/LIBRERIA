/*

esto no se usa pero es interesante dejarlo por si quedan dudas de las expresiones regulares usadas.

const regex = {
    nombre: /^[a-zA-Z\s]{4,50}$/,  //letras mayusculas, minusculas, y espacios, entre 4 y 50 caracteres
    apellido: /^[a-zA-Z\s]{4,50}$/, //letras mayusculas, minusculas y espacios, entre 4 y 50 caracteres
    cedula: /^\d{8}$/, //numeros, 8 caracteres exactamente
    localidad: /[A-Za-z0-9\s]{4,150}/, //cualquier palabra, sin caracteres especiales, entre 4 y 150 caracteres
    username: /\S{4,16}$/, //todo menos espacios, entre 4 y 16 caracteres
    password: /\S{4,16}$/ //todo menos espacios, entre 4 y 16 caracteres
}
*/

let menu_abierto = false;

function abrir_menu() {
  let menu = document.getElementById("menu_botones");
  if (!menu_abierto) {
    menu.style.transform = "translateX(0)";
    menu_abierto = true;
  } else {
    menu.style.transform = "translateX(100vw)";
    menu_abierto = false;
  }
}

const insertar_user = () => {
  let add_inputs = document.querySelectorAll("#form_insertar_usuario input");
  const add_data = new FormData();
  add_data.set("nombre", add_inputs[0].value);
  add_data.set("apellido", add_inputs[1].value);
  add_data.set("ci", add_inputs[2].value);
  add_data.set("localidad", add_inputs[3].value);
  add_data.set("fecha_nacimiento", add_inputs[4].value);
  add_data.set("username", add_inputs[5].value);
  add_data.set("password", add_inputs[6].value);

  fetch("user_functions/c_add_user.php", {
    method: "POST",
    body: add_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_add) {
      let resultado = new Array();
      resultado = JSON.parse(respuesta_add);

      let alerta_add = document.getElementById("alerta_add");
      let error_add = document.getElementsByClassName("error_add");

      for (let iterator of error_add) {
        if (iterator.classList.contains("div_error")) {
          iterator.classList.remove("div_error");
          iterator.innerHTML = "";
        }
      }

      if (resultado["estado"] == 0) {
        alerta_add.innerHTML =
          '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No se agrego el usuario</p> </div>';

        for (const key in resultado) {
          if (key != "estado") {
            
            error_add[key].classList.add("div_error");
            error_add[key].innerHTML = "";

            error_add[key].innerHTML =
              '<p class="error_p">' + resultado[key] + "</p>";
          }
        }

      

      } else {
        alerta_add.innerHTML =
          '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Se agrego el usuario</p> </div>';
      }
    });
};

//baneo de usuarios

const banear_user = () => {
  let input_baneo = document.getElementById("ban_username");

    const ban_data = new FormData();
   ban_data.set("username", input_baneo.value);

  fetch("user_functions/c_ban_user.php", {
    method: "POST",
    body: ban_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_baneo) {
      let alerta = document.getElementById('alerta_ban');
      let resultado = new Array()
      resultado = JSON.parse(respuesta_baneo);

      if(resultado['estado'] == 1){
        alerta.innerHTML=
        '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>' + resultado[0] + '</p> </div>';
        
      }else{
        alerta.innerHTML=
        '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>'+ resultado[0]  +'</p> </div>';

      }

      
    });
};

//SCRIPT PARA ASIGNAR ADMINISTRADORES

const asign_admin = () => {
  let inputs_asign_admin = document.querySelectorAll("#form_asign_admin input");

  const asign_data = new FormData();
  asign_data.set("ci", inputs_asign_admin[0].value);
  asign_data.set("sucursal", inputs_asign_admin[1].value);
  asign_data.set("clave_seguridad", inputs_asign_admin[2].value);

  fetch("user_functions/c_asign_admin.php", {
    method: "POST",
    body: asign_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_asign) {
      let alerta = document.getElementById('alert_asign_adm');
      let error_asign_adm = Document.getElementsByClassName('erros')
      let resultado = new Array();
      resultado = JSON.parse(respuesta_asign)


      if(resultado['estado'] == 1){
        alerta.innerHTML = 
        '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>' + resultado[0] + '</p> </div>';
      }else{
        alerta.innerHTML =
        '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>'+ resultado[3]  +'</p> </div>';



      }

    });
  };
  
//SCRIPT PARA BUSCAR USUARIO PARA MODIFICAR
let inputs_mod_user = document.querySelectorAll("#form_modificar_user input");

function enviar_ci() {
  let input_ci = document.getElementById("CI_buscar");
  let envio = new FormData();
  envio.set("ci", input_ci.value);

  fetch("user_functions/c_buscar_user.php", {
    method: "POST",
    body: envio,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_buscar) {
      let alerta = document.getElementById('alerta_buscar');
      let arr_datos = new Array();
      arr_datos = JSON.parse(respuesta_buscar);
      let inputs_mod_user = document.querySelectorAll("#form_modificar_user input");



      if(arr_datos['estado'] == 0){
        alerta.innerHTML =
        '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>'+ arr_datos[0]  +'</p> </div>';
      }else{

      for (const key in arr_datos) {
        if(key != 'estado'){
          inputs_mod_user[key].value = arr_datos[key];
        }


        }
      }
    });
}
// SCRIPT PARA MODIFICAR LOS DATOS DEL USUARIO

const modificar_user = () => {
  const mod_data = new FormData();

  mod_data.set("nombre", inputs_mod_user[0].value);
  mod_data.set("ci", inputs_mod_user[1].value);
  mod_data.set("apellido", inputs_mod_user[2].value);
  mod_data.set("localidad", inputs_mod_user[3].value);
  mod_data.set("fecha_nacimiento", inputs_mod_user[4].value);
  mod_data.set("username", inputs_mod_user[5].value);

  fetch("user_functions/c_mod_user.php", {
    method: "POST",
    body: mod_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_mod_user) {
      let alerta = document.getElementById('alerta_upd');
      resultado = new Array();
      resultado = JSON.parse(respuesta_mod_user);
      let error_upd = document.getElementsByClassName('error_upd');


      for (const iterador of error_upd) {
        if(iterador.classList.contains('div_error')){
          iterador.classList.remove('div_error');
          iterador.innerHTML = '';
        }
      }



      if(resultado['estado'] == 1){

        alerta.innerHTML =
        '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Usuario modificado correctamente </p> </div>';
      }else{
        alerta.innerHTML = 
        '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No se pudo modificar el usuario</p> </div>';

        for (const key in resultado) {

            if(key != 'estado'){
              error_upd[key].innerHTML = resultado[key];
              error_upd[key].classList.add('div_error');
            }
            console.log(resultado[key]);
            
          }
        }


      
      
    });
};






//script de la tabla

const cargar_tabla = () => {
  let table = document.getElementById("result_consulta_usuario");
  let busqueda = document.getElementById("buscar_libro_input").value;
  const buscar_data = new FormData();
  buscar_data.set("condicion", busqueda);

  fetch("user_functions/c_cargar_tabla_user.php", {
    method: "POST",
    body: buscar_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_busqueda_users) {
      table.innerHTML = "";
      table.innerHTML = respuesta_busqueda_users;
    });
};

window.onload = cargar_tabla();
