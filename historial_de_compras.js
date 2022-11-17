const cargar_historial = () => {
  let historial_de_compras = document.getElementById("historial_de_compras");

  fetch("functions/c_cargar_historial_compras.php")
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (respuesta_historial) {
      console.log("aaa");
      historial_de_compras.innerHTML = "";
      historial_de_compras.innerHTML = respuesta_historial;
    });
};

window.onload = cargar_historial;
