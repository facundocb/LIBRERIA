<?php 

session_start();

include("layout/header.php");

?>


    <h1 class='titulo'>Mi cuenta</h1>
    <div id="container_info_de_perfil">
        
        <div id="menu">
            <a href="info_de_perfil.php"><h4 class='opcion'>Datos personales</h4></a>
            <a href="historial_de_compras.php"><h4 class='opcion selected'>Historial de compras</h4></a>
            <a href="functions/cerrar_sesion.php"><h4 class='opcion'>Salir</h4></a>
        </div>

        <div id="historial_de_compras">
            <h2 class="titulo">Historial de compras</h2>
            <p>No tienes ninguna compra realizada!</p>
        </div>








    </div>

