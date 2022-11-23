function registrar_usuario() {
  let register_user = document.querySelectorAll(".input_general");
  let cont_errors = document.querySelectorAll(".error_container");
  let result = document.querySelector("#result_register");
  register_data = new FormData();

  register_data.set("nom", register_user[0].value);
  register_data.set("ape", register_user[1].value);
  register_data.set("local", register_user[2].value);
  register_data.set("ci", register_user[3].value);
  register_data.set("fecha_nac", register_user[4].value);
  register_data.set("user", register_user[5].value);
  register_data.set("pass", register_user[6].value);
  register_data.set("conf_pass", register_user[7].value);

  fetch("c_registrar_usuario.php", {
    method: "POST",
    body: register_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (respuesta_registro) {
      resultado = new Array();

      resultado = JSON.parse(respuesta_registro);

      for (const key in cont_errors) {
          cont_errors[key].innerHTML = "";
      }

      if (resultado["estado"] == 0) {
          result.innerHTML =
            '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No se agrego el usuario</p> </div>';

          for (const key in resultado) {
            if(key != 'estado'){
              cont_errors[key].innerHTML = "";
              cont_errors[key].innerHTML =
              '<p class="error_p">' + resultado[key] + "</p>";
            }
          }
      } else {
          result.innerHTML =
          '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Se agrego el usuario</p> </div>';
      }
    });
}
