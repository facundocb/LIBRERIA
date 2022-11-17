function add_to_cart() {
  let id = localStorage.getItem("id_libro");
  let cantidad = document.getElementById("cantidad").value;
  let result = document.getElementById("result");

  const add_to_cart_Data = new FormData();

  add_to_cart_Data.set("id_libro", id);
  add_to_cart_Data.set("cantidad", cantidad);

  fetch("c_agregar_al_estante.php", {
    method: "POST",
    body: add_to_cart_Data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "error";
      }
    })
    .then(function (respuesta_agregar_al_estante) {
      result.style.height = "6vh";
      result.innerHTML = respuesta_agregar_al_estante;
    });
}
