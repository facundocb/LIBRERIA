<?php 

session_start();

include("layout/header.php");

?>


    <h1 class='titulo'>Mi cuenta</h1>
    <div id="container_info_de_perfil">
        
        <div id="menu">
            <a href="info_de_perfil.php"><h4 class='opcion selected'>Datos personales</h4></a>
            <a href="historial_de_compras.php"><h4 class='opcion'>Historial de compras</h4></a>
            <a href="functions/cerrar_sesion.php"><h4 class='opcion'>Salir</h4></a>
        </div>
        
        <div id='datos_personales'>
            <div class="titulo_container">
                <h2 class='titulo'>Datos</h2>
                <button id='edit'><span class="material-icons">edit</span></button>
            </div>
                
            <div class="content">
                <p class="subtitulo">Nombre: </p>
                <p class="datos"></p>
            </div>
            <div class="content">
                <p class="subtitulo">Apellido: </p>
                <p class="datos"></p>
            </div>
            <div class="content">
                <p class="subtitulo">Localidad: </p>
                <p class="datos"></p>
            </div>
            <div class="content">
                <p class="subtitulo">Cedula de Identidad: </p>
                <p class="datos"></p>
            </div>
            <div class="content">
                <p class="subtitulo">Nombre de usuario: </p>
                <p class="datos"></p>
            </div>
            <div class="content">
                <p class="subtitulo">clave: </p>
                <p class="datos">*********</p>
            </div>

        </div>

    </div>

    <script src='info_de_perfil.js'></script>