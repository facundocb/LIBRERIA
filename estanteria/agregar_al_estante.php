<?php
    session_start();
    include("functions/conexion.php");


    $cantidad = $_POST['cantidad'];
    $user = $_SESSION['username'];


    if(consulta_estanteria_activa($user)){

        

    }
    else{
        echo 'b';
    }




?>