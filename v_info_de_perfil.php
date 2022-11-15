<?php 

session_start();

include("layout/header.php");

?>


    <h1 class='titulo'>Mi cuenta</h1>
    <div id="container_info_de_perfil">
        
        <div id="menu">
            <a href="v_info_de_perfil.php"><h4 class='opcion selected'>Datos personales</h4></a>
            <a href="v_historial_de_compras.php"><h4 class='opcion'>Historial de compras</h4></a>
            <a href="/LIBRERIA/functions/c_cerrar_sesion.php"><h4 class='opcion'>Salir</h4></a>
        </div>
        
        <div id='datos_personales'>
            <div class="titulo_container">
                <h2 class='titulo'>Datos</h2>
                <button id='edit' onclick="modificar_datos()"><span class="material-icons">edit</span></button>
            </div>
                
            <div class="content">
                <p class="subtitulo">Nombre: </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo">Apellido: </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo">Localidad: </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo">Cedula </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo">Nacimiento: </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo">Username: </p>
                <input type="text" disabled class="input_general" name='datos'>
            </div>
            <div class="content">
                <p class="subtitulo" id='pass'>clave: </p>
                <input type="text" disabled class="input_general" name='datos' value='**********'>
            </div>

        </div>

    </div>


    <script src="/LIBRERIA/layout/script.js"></script>
    <script src='info_de_perfil.js'></script>