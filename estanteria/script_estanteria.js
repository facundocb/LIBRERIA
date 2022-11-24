function cargar_datos() {
  let user = localStorage.getItem("user");

  let cargar_data = new FormData();
  cargar_data.set("user", user);

  fetch("../functions/c_cargar_info_user.php", {
    method: "POST",
    body: cargar_data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_cargar_user) {
      let arr_datos_user = new Array();
      arr_datos_user = JSON.parse(respuesta_cargar_user);
      let inputs_user = document.querySelectorAll(".input_texto");

      inputs_user[0].value = arr_datos_user["ci"];
      inputs_user[1].value = arr_datos_user["nom"];
      inputs_user[2].value = arr_datos_user["ape"];
      inputs_user[3].value = arr_datos_user["loc"];
    });
}

window.onload = cargar_datos();

function comprar() {
  let compra_data = new FormData();
  let alerta = document.getElementById("alerta_compra");

  let metodo_elegido = document.querySelector(
    'input[name="metodo"]:checked'
  )

  if(!metodo_elegido){
    alerta.innerHTML = 
    '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No pusiste ningun método de pago</p> </div>';

  }else{

  
    compra_data.set("metodo_de_pago", metodo_elegido.value);
  
    fetch("c_compra.php", {
      method: "POST",
      body: compra_data,
    })
      .then(function (response) {
        if (response.ok) {
          return response.text();
        } else {
          throw "error";
        }
      })
      .then(function () {
        location.reload();
      });
  }
  
  
  
  
  function borrar_prod(id){
  
    let borrar_data = new FormData;
  
    borrar_data.set('id', id)
  
    fetch("c_borrar_prod.php", {
      method:"POST",
      body: borrar_data
    })
    .then(function(response){
      if(response.ok){
        return response.text()
      }else{
        throw "Error";
      }
    })
    .then(function(respuesta_borrar_prod){
      location.reload();
    })
  
  
  
    }

  }  


