<?php 
include("functions/conexion.php");
session_start();

$ci = $_SESSION['ci']; //agarra la ci de la sesion antes usada

$pass = $_POST['password']; 
$pass_conf = $_POST['confirm_password'];

if(strlen($pass) < 7){
    header("location:v_recuperar_clave.php?error=2"); //si son mas chicas que 7 caracteres, tira error dos y corta ahi para que no siga leyendo el codigo
    die();
}


if($pass != $pass_conf){
    header("location:v_recuperar_clave.php?error=1"); //si son diferentes tira error uno y corta tambien
    die();
}else{

    $hash_pass = password_hash($pass, PASSWORD_DEFAULT); //la hashea
    actualizar_pass($ci, $hash_pass); //la actualiza

    header("location:v_recuperar_clave.php?success=1"); //tira exito y redirecciona.

}




?>