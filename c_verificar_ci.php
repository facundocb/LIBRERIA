<?php 
include("functions/conexion.php");

$ci = $_POST['ci'];

    if(consulta_CI($ci) && !consulta_cedula_administrador($ci)){
        session_start();
        $_SESSION['ci'] = $ci;
        
        header("location:v_recuperar_clave.php");


    }
    else{
        header("location:v_cambiar_clave.php?error=1");
    }







?>