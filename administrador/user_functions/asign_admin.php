<?php 
include('../../functions/conexion.php');


$ci = $_POST['ci'];
$sucursal = $_POST['sucursal'];
$clave_seguridad = password_hash($_POST['clave_seguridad'], PASSWORD_DEFAULT);
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

if(consulta_cedula_administrador($ci)){
    $errors[2]= 'el usuario ya es administrador!';
}     




     if(!isset($errors)){
        insertar_admin($ci, $sucursal, $clave_seguridad);
        $msj_return = 'usuario ingresado';
     }else{
        $msj_return = 'no se pudo agregar';
  
        
    }



     echo $msj_return;

?>