
let input_datos = document.querySelectorAll('.input_general');
const mostrar_datos = () =>{
    

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
            input_datos[0].value = datos_user['nom'];        
            input_datos[1].value = datos_user['ape'];
            input_datos[2].value = datos_user['loc'];
            input_datos[3].value = datos_user['ci'];
            input_datos[4].value = datos_user['nac'];
            input_datos[5].value = datos_user['usr'];

        }


    })
}

window.onload = mostrar_datos;



let flag = 0

function modificar_datos(){

    if(!flag){
        for (let i = 0; i < input_datos.length; i++) {
            input_datos[i].disabled = false;
        
        }
        let p = document.getElementById('pass');
            remove(p);
    flag = 1;
    }else{
        for (let i = 0; i < input_datos.length; i++) {
            input_datos[i].disabled = true;
            
        }
    flag = 0
    }

}

