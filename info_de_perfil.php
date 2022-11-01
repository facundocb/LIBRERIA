<?php 

session_start();

include("layout/header.php");

?>


    <h1 class='titulo'>Mi cuenta</h1>
    <div id="container_info_de_perfil">
        
        <div id="menu">
            <h4 class='opcion'>Datos personales</h4>
            <h4 class='opcion'>Historial de compras</h4>
            <h4 class='opcion'>Salir</h4>
        </div>
        
        <div id='datos_personales'>
            <div class="titulo_container">
                <h2 class='titulo'>Datos</h2>
                <button id='edit'><span class="material-icons">edit</span> Editar mi perfil </button>
            </div>
                
            <div class="content">
                <p class="subtitulo">Nombre: </p>
                <p class="datos">Facundo</p>
            </div>
            <div class="content">
                <p class="subtitulo">Apellido: </p>
                <p class="datos">Cuello</p>
            </div>
            <div class="content">
                <p class="subtitulo">Localidad: </p>
                <p class="datos">Marindia</p>
            </div>
            <div class="content">
                <p class="subtitulo">Cedula de Identidad: </p>
                <p class="datos">55054034</p>
            </div>
            <div class="content">
                <p class="subtitulo">Nombre de usuario: </p>
                <p class="datos">chito1212</p>
            </div>
            <div class="content">
                <p class="subtitulo">clave: </p>
                <p class="datos">********</p>
            </div>

        </div>





    </div>