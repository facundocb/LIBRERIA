<?php 
    session_start();
    include("../../functions/conexion.php");

    $NOMBRE= $_POST['nombre'];
    $APELLIDO = $_POST['apellido'];
    $CI = $_POST['ci'];
    $LOCALIDAD = $_POST['localidad'];

    if($_POST['fecha_nacimiento'] != ''){
        $FECHA_NACIMIENTO = $_POST['fecha_nacimiento'];
    }
    else{
        $errors[4] = 'fecha no valida';
    }



    $USERNAME = $_POST['username'];        
    $PASSWD = $_POST['password'];
    $errors;
    $msj_return_insert;
     //VALIDACIONES

    

     if(strlen($NOMBRE) < 2 || !preg_match("/^[a-zA-Z\s]{4,50}$/",$NOMBRE))
     {
         $errors[0] ='el nombre debe tener entre 4 y 50 caracteres, no se permiten numeros';
     }    
    

    if(strlen($APELLIDO) < 2 || !preg_match("/^[a-zA-Z\s]{4,50}$/",$APELLIDO))
     {
         $errors[1]= 'el apellido debe tener entre 4 y 50 caracteres, no se permiten numeros';
     }

     if(strlen($CI) < 8 || !preg_match("/^\d{8}$/",$CI))
     {
         $errors[2]='Ingresá la cedula sin puntos ni guiones(Ej: 1.234.567-8 ingresá 12345678)';
     }
     else
     { 
         //funcion de conexion.php
         if(consulta_CI($CI)){
             $errors[2]="La CI ya existe";
         }
     }


     if(strlen($LOCALIDAD) < 4 || !preg_match("/^[a-zA-Z0-9\s]{4,50}$/",$LOCALIDAD))
     {
         $errors[3]='La ciudad no puede tener caracteres especiales, debe tener entre 4 y 150 caracteres';
     }
   
     

     if(strlen($USERNAME) < 4 || preg_match("/\s/", $USERNAME))
     {
         $errors[5]='el usuario no puede tener espacios y debe tener entre 4 y 16 caracteres';
     }
     else
     {
         //funcion de conexion.php
       if(consulta_usuario($USERNAME)){
         $errors[5]='el usuario ya está en uso';
       }
     }

     if(strlen($PASSWD) < 8 || preg_match("/\s/", $PASSWD))
     {
        $errors[6]='la clave no puede tener espacios y debe tener entre 4 y 16 caraceteres';
     }



    if(!isset($errors)){
        insertar_cliente($CI, $NOMBRE, $APELLIDO, $LOCALIDAD, $FECHA_NACIMIENTO, $USERNAME, $PASSWD);

        $errors['estado'] = 1; 
        echo json_encode($errors);
    }
    else{        
        $errors['estado'] = 0 ;
        echo json_encode($errors);
        }   


 
  ?>
