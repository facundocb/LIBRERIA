
const mostrar_datos = () =>{
    let p_datos = document.querySelectorAll('.datos');
    

    fetch('functions/cargar_info_user.php')
    .then(function(response){
        if(response.ok){
            return response.text();
        }else{
            throw 'error';
        }
    })
    .then(function(respuesta_datos_user){
        datos_user = new Array();
        datos_user = JSON.parse(respuesta_datos_user);

        p_datos[0].innerHTML = datos_user['nom'];        
        p_datos[1].innerHTML = datos_user['ape'];
        p_datos[2].innerHTML = datos_user['loc'];
        p_datos[3].innerHTML = datos_user['ci'];
        p_datos[4].innerHTML = datos_user['usr'];


    })
}

window.onload = mostrar_datos;