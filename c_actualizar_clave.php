<?php 
include("functions/conexion.php");
session_start();

$ci = $_SESSION['ci'];

$pass = $_POST['password'];
$pass_conf = $_POST['confirm_password'];

if(strlen($pass) < 7){
    header("location:v_recuperar_clave.php?error=2");
    die();
}


if($pass != $pass_conf){
    header("location:v_recuperar_clave.php?error=1");
    die();
}else{

    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    actualizar_pass($ci, $hash_pass);

    header("location:v_recuperar_clave.php?success=1");

}




?>