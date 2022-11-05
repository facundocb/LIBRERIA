

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
    

add_data.forEach(element => {
    console.log(element);
});


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
        console.log(respuesta_add_book);
    });
}


const cargar_tabla = () => {
    let table = document.getElementById('result_consulta');
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
        table.innerHTML = "";
        table.innerHTML = respuesta_busqueda_libros;


    })

}

window.onload = cargar_tabla();

   


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

        inputs_mod_book[0].value = arr_datos_libro['id_libro'];
        inputs_mod_book[1].value = arr_datos_libro['nom_libro']        
        inputs_mod_book[2].value = arr_datos_libro['descripcion_libro']
        inputs_mod_book[3].value = arr_datos_libro['precio_libro']
        inputs_mod_book[4].value = arr_datos_libro['stock_libro']
        inputs_mod_book[5].value = arr_datos_libro['autor_libro']
        inputs_mod_book[6].value = arr_datos_libro['genero_libro']
        inputs_mod_book[7].value = arr_datos_libro['editorial_libro'];
        inputs_mod_book[8].value = arr_datos_libro['fecha_publicacion_libro'];

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
        console.log(respuesta_mod_book);
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

