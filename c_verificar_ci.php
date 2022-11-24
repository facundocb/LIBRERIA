<?php 
include("functions/conexion.php");

$ci = $_POST['ci'];

    if(consulta_CI($ci) && !consulta_cedula_administrador($ci)){ //si existe y no es admin
        session_start();
        $_SESSION['ci'] = $ci; //lo guarda en una sesion  
        header("location:v_recuperar_clave.php"); //te lleva a recuperar la clave

    }
    else{
        header("location:v_cambiar_clave.php?error=1"); //te manda atras con una alerta
    }







?>