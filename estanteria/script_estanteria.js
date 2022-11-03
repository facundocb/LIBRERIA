
function cargar_datos(){
    
    let user = localStorage.getItem("user");

    let cargar_data = new FormData;
    cargar_data.set('user', user);


    fetch("../functions/cargar_info_user.php", {
        method: 'POST',
        body: cargar_data
    })
    .then(function(response){
        
        if(response.ok){
            return response.text()
        }else{
            throw 'error';
        }

    })
    .then(function(respuesta_cargar_user){
        let arr_datos_user = new Array();
        arr_datos_user = JSON.parse(respuesta_cargar_user);
        let inputs_user = document.querySelectorAll('.input_texto');

        inputs_user[0].value = arr_datos_user['ci'];
        inputs_user[1].value = arr_datos_user['nom'];
        inputs_user[2].value = arr_datos_user['ape'];
        inputs_user[3].value = arr_datos_user['loc'];

    })
}

window.onload = cargar_datos();



function comprar(){
    let user = localStorage.getItem("user");
    let datos_compra = new FormData;
    let cantidades
    datos_compra.set("cantidad")


}





