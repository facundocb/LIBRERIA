<?php 

session_start();

include("layout/header.php");

?>


    <h1 class='titulo'>Mi cuenta</h1>
    <div id="container_info_de_perfil">
        
        <div id="menu">
            <a href="v_info_de_perfil.php"><h4 class='opcion'>Datos personales</h4></a>
            <a href="v_historial_de_compras.php"><h4 class='opcion selected'>Historial de compras</h4></a>
            <a href="functions/c_cerrar_sesion.php"><h4 class='opcion'>Salir</h4></a>
        </div>

        <div id="historial_de_compras">

        
        </div>







        <script src="/LIBRERIA/layout/script.js"></script>
        <script src="/LIBRERIA/historial_de_compras.js"></script>
    </div>

