
const mostrar_datos = () =>{
    let p_datos = document.querySelectorAll('.datos');
    

    fetch('functions/c_cargar_info_user.php')
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

        if(datos_user['estado'] == 0){
            console.log('fatal error');
        }else{        
            p_datos[0].innerHTML = datos_user['nom'];        
            p_datos[1].innerHTML = datos_user['ape'];
            p_datos[2].innerHTML = datos_user['loc'];
            p_datos[3].innerHTML = datos_user['ci'];
            p_datos[4].innerHTML = datos_user['usr'];
        }


    })
}

window.onload = mostrar_datos;