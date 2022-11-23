

const insertar_libro = () => {
    let add_libros = document.querySelectorAll('#form_agregar_libro input');
    let img_imput = document.querySelector('#imagen_libro');
    const add_data = new FormData;
    
    add_data.append('file', img_imput.files[0]);
    add_data.set("nom_libro", add_libros[0].value);
    add_data.set("descripcion_libro", add_libros[1].value);
    add_data.set("precio_libro", add_libros[2].value);
    add_data.set("stock_libro", add_libros[3].value);
    add_data.set("autor_libro", add_libros[5].value);
    add_data.set("genero_libro", add_libros[6].value);
    add_data.set("fecha_publicacion_libro", add_libros[7].value);
    add_data.set("editorial_libro", add_libros[8].value);
    

    fetch("book_functions/c_add_book.php",
    {
        method: 'POST',
        body: add_data

    })
    .then(function(response)
    {
        if(response.ok)
        {
            return response.text();
        }else
        {
            throw 'error';
        }
    })
    
    .then(function(respuesta_add_book)
    {
        let resultado = new Array();
        resultado = JSON.parse(respuesta_add_book);
        let alerta = document.getElementById('alerta_add');
        let error_add = document.getElementsByClassName('error_add')

        for (let iterator of error_add) {
            if(iterator.classList.contains('div_error')){
                iterator.classList.remove('div_error');
                iterator.innerHTML = '';
            }
        }

            if(resultado['estado'] == 1){
                alerta.innerHTML = 
                '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Se agrego el usuario</p> </div>';
            }else{
                
                alerta.innerHTML=
                '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span> No se pudo agregar al usuario </p> </div>';

                for(const key in resultado){
                    if(key != 'estado'){

                        error_add[key].classList.add('div_error');
                        error_add[key].innerHTML = 
                        '<p class="error_p">' + resultado[key] + "</p>";
                        
                    }

                }


            }



        




    });
}


const cargar_tabla = () => {
    let listado = document.getElementById('listado');
    let busqueda = document.getElementById('buscar_libro_input').value
    const buscar_data = new FormData;
    buscar_data.set("condicion", busqueda)
       
   fetch("book_functions/c_cargar_tabla_libros.php", {
    
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
    .then(function(respuesta_busqueda_libros){
        listado.innerHTML = "";
        listado.innerHTML = respuesta_busqueda_libros;


    })

}

window.onload = cargar_tabla();

const mostrar_alerta_stock = () =>{
    alerta = document.getElementById('alerta');

    fetch("book_functions/c_alerta_stock.php")

    .then(function(response){
        if(response.ok){
            return response.text();
        }else{
            throw "error";
        }
    })
    .then(function(alerta_stock){
        alerta.innerHTML = alerta_stock;
    })
    
}   

window.onload = mostrar_alerta_stock();


//esto es para buscar el libro y guardarlo en un array
let inputs_mod_book = document.querySelectorAll('#form_modificar_datos_libro input')
const enviar_ID = () =>{
    let ID_buscada = document.getElementById('buscarID');
   
    const buscar_libro_data = new FormData;
    buscar_libro_data.set("ID", ID_buscada.value);

    fetch('book_functions/c_buscar_book.php',{ 
    method: 'POST',
    body: buscar_libro_data
    
    })
    .then(function(response){
        if(response.ok){
            return response.text()
        }else{
            throw 'error';
        }
    }) .then(function(respuesta_buscar_book){
        let arr_datos_libro = new Array();
        arr_datos_libro= JSON.parse(respuesta_buscar_book);
        let alerta = document.getElementById('alerta_buscar');

        
        if(alerta.classList.contains('error')){
            alerta.innerHTML = '';
            alerta.classList.remove('error');
        }

        if(arr_datos_libro['estado'] == 1){
            for(const key in arr_datos_libro){
                if(key != 'estado'){

                    inputs_mod_book[key].value = arr_datos_libro[key]
                }
            }
        }else{
            alerta.classList.add('error');
            alerta.innerHTML = 
            '<p class="error_texto"><span class="material-icons">warning</span>'+ arr_datos_libro[0]  +'</p>';
        }


       
    })
}


//esto es para modificarlo 


const modificar_libro = () =>{
    const mod_libro_data = new FormData;
    
    mod_libro_data.set("ID",inputs_mod_book[0].value)
    mod_libro_data.set("nom_libro",inputs_mod_book[1].value)
    mod_libro_data.set("descripcion_libro",inputs_mod_book[2].value)
    mod_libro_data.set("precio_libro",inputs_mod_book[3].value)
    mod_libro_data.set("stock_libro",inputs_mod_book[4].value)
    mod_libro_data.set("autor_libro",inputs_mod_book[5].value)
    mod_libro_data.set("genero_libro",inputs_mod_book[6].value)
    mod_libro_data.set("editorial_libro",inputs_mod_book[7].value)
    mod_libro_data.set("fecha_publicacion_libro",inputs_mod_book[8].value)

    fetch('book_functions/c_mod_book.php', {

        method: 'POST',
        body: mod_libro_data

    })

    .then(function(response){
        
        if(response.ok){
            return response.text();
        }else{
            throw 'error';
        }
    })
    .then(function(respuesta_mod_book){
        let alerta = document.getElementById('alerta_mod');
        let error_mod = document.getElementsByClassName('error_mod');
        let result = new Array();
        result = JSON.parse(respuesta_mod_book);


        for (const iterator of error_mod) {
            if(iterator.classList.contains('error')){
                iterator.classList.remove('error');
            }
        }
     

        
        if(result['estado'] == 0){

            alerta.innerHTML=
          '<div class="error"> <p class="error_texto"><span class="material-icons">warning</span>No se modificó el libro</p> </div>';
            

            for (const key in result) {

                if(key != 'estado'){
                    error_mod[key].innerHTML = 
                    '<p class="error_p">' + result[key] + "</p>";

                }

            }
        }else{
            alerta.innerHTML=
            '<div class="ok"> <p class="ok_texto"><span class="material-icons">done</span>Se modifico el libro</p> </div>';
        }



    })
}





const banear_libro = () =>{
    
    let ID_cambiar_estado = document.getElementById('ID_cambiar_estado');
    const ban_libro_data = new FormData;
    ban_libro_data.set("ID", ID_cambiar_estado.value)




    fetch('book_functions/c_ban_book.php', {

        method: 'POST',
        body: ban_libro_data
    })
    .then(function(response){
        if(response.ok){
            return response.text()
        }else{
            throw "ERROR";
        }
    }).then(function(respuesta_ban_book){

        console.log(respuesta_ban_book);

    })
}

// esto es para habilitarlo

const desbanear_libro = () =>{
    
    let ID_cambiar_estado = document.getElementById('ID_cambiar_estado');
    const habilitar_data = new FormData;

    habilitar_data.set("ID", ID_cambiar_estado.value);

    fetch('book_functions/c_desban_book.php', {
        method:'POST',
        body: habilitar_data
    })
    .then(function(response){
        if(response.ok){
            return response.text();
        }
        else{
            throw "ERROR";
        }
    }).then(function(respuesta_desban_book){
        console.log(respuesta_desban_book)
    })



}
