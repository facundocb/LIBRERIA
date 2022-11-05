/*

esto no se usa pero es interesante dejarlo por si quedan dudas de las expresiones regulares usadas.

const regex = {
    nombre: /^[a-zA-Z\s]{4,50}$/,  //letras mayusculas, minusculas, y espacios, entre 4 y 50 caracteres
    apellido: /^[a-zA-Z\s]{4,50}$/, //letras mayusculas, minusculas y espacios, entre 4 y 50 caracteres
    cedula: /^\d{8}$/, //numeros, 8 caracteres exactamente
    localidad: /[A-Za-z0-9\s]{4,150}/, //cualquier palabra, sin caracteres especiales, entre 4 y 150 caracteres
    username: /\S{4,16}$/, //todo menos espacios, entre 4 y 16 caracteres
    password: /\S{4,16}$/ //todo menos espacios, entre 4 y 16 caracteres
}
*/


let regex =/^[a-zA-Z]\s$/;



const insertar_user = () => {
    let add_inputs = document.querySelectorAll('#form_insertar_usuario input');
    const add_data = new FormData();
    add_data.set('nombre', add_inputs[0].value);
    add_data.set('apellido', add_inputs[1].value);
    add_data.set('ci', add_inputs[2].value);
    add_data.set('localidad', add_inputs[3].value);
    add_data.set('fecha_nacimiento', add_inputs[4].value);
    add_data.set('username', add_inputs[5].value);
    add_data.set('password', add_inputs[6].value);
    

    fetch('user_functions/c_add_user.php', 
    {
        method: 'POST',
        body: add_data
    })
    .then(function(response)
    {
        if(response.ok){
            return response.text();
        } else{
            throw 'error';
        }

    })
    .then(function(respuesta)
    {
        console.log(respuesta);
    })

}

//baneo de usuarios

const banear_user = () =>{
    
    let input_baneo = document.getElementById('ban_username');

    const ban_data = new FormData();
    ban_data.set('username', input_baneo.value);


    fetch('user_functions/c_ban_user.php', {
        method: 'POST',
        body: ban_data
    })
        .then(function(response){
            if(response.ok){
                return response.text();
            }
            else{
                throw 'error';
            }
        })
        .then(function(respuesta_baneo){
            console.log(respuesta_baneo);
        })
}

//SCRIPT PARA ASIGNAR ADMINISTRADORES


const asign_admin = () =>{


    let inputs_asign_admin = document.querySelectorAll('#form_asign_admin input');


    const asign_data = new FormData;
    asign_data.set('ci', inputs_asign_admin[0].value);
    asign_data.set('sucursal', inputs_asign_admin[1].value);
    asign_data.set('clave_seguridad', inputs_asign_admin[2].value)


    fetch('user_functions/c_asign_admin.php', {
        method: 'POST',
        body: asign_data
    })
    .then(function(response){
        if(response.ok){
            return response.text()
        }else{
            throw 'error';
        }
    })
    .then(function(respuesta_asign){
        console.log(respuesta_asign);
    })
}


//SCRIPT PARA BUSCAR USUARIO PARA MODIFICAR
let inputs_mod_user = document.querySelectorAll('#form_modificar_user input');

function enviar_ci()
{
    let input_ci = document.getElementById("CI_buscar");
    let envio = new FormData;
    envio.set('ci', input_ci.value);

    fetch('user_functions/c_buscar_user.php', {
        method: 'POST',
        body: envio
    })
    .then(function(response){
        if(response.ok){
            return response.text();
        }
        else{
            throw 'error';
        }
    })
    .then(function(respuesta_buscar){
        //console.log(respuesta_buscar);
        let arr_datos = new Array();
        arr_datos= JSON.parse(respuesta_buscar);
       
            inputs_mod_user[0].value = arr_datos['nombre'];
            inputs_mod_user[1].value = arr_datos['cedula'];
            inputs_mod_user[2].value = arr_datos['apellido'];
            inputs_mod_user[3].value = arr_datos['localidad'];
            inputs_mod_user[4].value = arr_datos['fecha_nacimiento']; 
            inputs_mod_user[5].value = arr_datos['username'];        
    })
}
// SCRIPT PARA MODIFICAR LOS DATOS DEL USUARIO


const modificar_user = () => {

    let inputs_mod_user = document.querySelectorAll('#form_modificar_user input');
    const mod_data = new FormData;

    mod_data.set("nombre", inputs_mod_user[0].value);
    mod_data.set("ci", inputs_mod_user[1].value);
    mod_data.set("apellido", inputs_mod_user[2].value);
    mod_data.set("localidad", inputs_mod_user[3].value);
    mod_data.set("fecha_nacimiento", inputs_mod_user[4].value);
    mod_data.set("username", inputs_mod_user[5].value);
    
    fetch('user_functions/c_mod_user.php', {
        method: 'POST',
        body: mod_data
        
    })
        .then(function(response){
            if(response.ok){
                return response.text();
            }else{
                throw 'error';
            }

        })
        .then(function(respuesta_mod_user){
        console.log(respuesta_mod_user);

    })


}


//script de la tabla


const cargar_tabla = () => {
    let table = document.getElementById('result_consulta');
    let busqueda = document.getElementById('buscar_libro_input').value
    const buscar_data = new FormData;
        buscar_data.set("condicion", busqueda)


   fetch("user_functions/c_cargar_tabla_user.php", {
    
        method: 'POST',
        body: buscar_data
    })
    .then(function(response){

        if(response.ok){
            return response.text();
        }else{
            throw 'error';
        }

    })
    .then(function(respuesta_busqueda_users){
        table.innerHTML = "";
        table.innerHTML = respuesta_busqueda_users;


    })
}

window.onload = cargar_tabla();