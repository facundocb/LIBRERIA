<?php 
include('../../functions/conexion.php');


$ci = $_POST['ci'];
$sucursal = $_POST['sucursal'];
$clave_seguridad = $_POST['clave_seguridad'];
$pass = $_POST['clave'];
$errors;
$msj_return;

//validaciones 

if(!preg_match("/^\d{8}$/",$ci))
{
    $errors[0]='Ingresá la cedula sin puntos ni guiones(Ej: 1.234.567-8 ingresá 12345678)';
}
else
{ 
    //funcion de conexion.php
    if(!consulta_CI($ci)){
        $errors[0]="La CI no existe";
    }
}

if(!preg_match("/^[a-zA-Z0-9\s]{4,50}$/",$sucursal))
     {
         $errors[1]='La sucursal no puede tener caracteres especiales, y debe tener entre 4 y 50 caracteres';
     }

     
if(!preg_match("/^[a-zA-Z0-9\s]{4,50}$/",$clave_seguridad))
    {
         $errors[2]='La clave no puede tener caracteres especiales, y debe tener entre 4 y 50 caracteres';
    }

if(strlen($pass) < 4)
    {
        $errors[3]='La pass no puede tener caracteres especiales, y debe tener entre 4 y 50 caracteres';    
    }


if(consulta_cedula_administrador($ci)){
    $errors[0]= 'el usuario ya es administrador';
}     




     if(!isset($errors)){


        $clave_seguridad_hash = password_hash($clave_seguridad, PASSWORD_DEFAULT);
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        insertar_admin($ci, $sucursal, $clave_seguridad_hash, $pass_hash);
        $result[0] = 'usuario asignado correctamente';
        $result['estado'] = 1;
        echo json_encode($result);
     }else{
        $errors['estado'] = 0;
        echo json_encode($errors);   
    }
?>