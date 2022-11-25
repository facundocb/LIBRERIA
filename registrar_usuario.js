function registrar_usuario() {
  let register_user = document.querySelectorAll(".input_general"); //inputs
  let cont_errors = document.querySelectorAll(".error_container"); //aca van a ir los errores de los inputs
  let result = document.querySelector("#result_register"); //este es el cont grande
  register_data = new FormData();

  register_data.set("nom", register_user[0].value);
  register_data.set("ape", register_user[1].value);
  register_data.set("local", register_user[2].value);
  register_data.set("ci", register_user[3].value);
  register_data.set("fecha_nac", register_user[4].value);
  register_data.set("user", register_user[5].value);
  register_data.set("pass", register_user[6].value);
  register_data.set("conf_pass", register_user[7].value);

  //agarra los valores de los inputs


  console.log(register_data.get("fecha_nac"));
  fetch("c_registrar_usuario.php", {
    method: "POST",
    body: register_data
    //le paso el form al controlador
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
        //si esta todo bien q traiga respuesta
      } else {
        throw "Error";
      }
    })
    .then(function (respuesta_registro) {
      resultado = new Array();

      resultado = JSON.parse(respuesta_registro);
      //guardo el json en un array 


      for (const key in cont_errors) {
          cont_errors[key].innerHTML = "";
      }
      //limpio el contenedor por las dudas


      //si el estado es 0, o sea fallido, entonces tira errores
      if (resultado["estado"] == 0) {
          result.innerHTML =
            '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No se agrego el usuario</p> </div>';
        
          for (const key in resultado) {
            //recorre todos los errores que trajo el json
            if(key != 'estado'){
            //la key tiene que ser diferente de estado pq tira undefined
              cont_errors[key].innerHTML = "";
              cont_errors[key].innerHTML =
              '<p class="error_p">' + resultado[key] + "</p>";
              //le pone el resultado en el contenedor inmediato abajo
            }
          }
      } else {
          result.innerHTML =
          '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Se agrego el usuario</p> </div>';
          //o sino deja un cartelito q dice todo bien
      }
    });
}
