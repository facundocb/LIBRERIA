const cargar_historial = () => {
  let historial_de_compras = document.getElementById("historial_de_compras");

  fetch("functions/c_cargar_historial_compras.php") //q cargue el historial
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (respuesta_historial) {
      historial_de_compras.innerHTML = ""; //lo resetee
      historial_de_compras.innerHTML = respuesta_historial; // y lo cargue
    });
};

window.onload = cargar_historial;
//cuando se carga el documento.