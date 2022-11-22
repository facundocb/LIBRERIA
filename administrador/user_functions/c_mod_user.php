<?php 
   
    include("../../functions/conexion.php");

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $localidad = $_POST['localidad'];
    if($_POST['fecha_nacimiento'] == ''){
        $errors[4] = 'fecha no valida';
    }else{
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
    }
    $username = $_POST['username'];


    if(!preg_match("/^[a-zA-Z\s]{4,50}$/",$nombre))
    {
        $errors[0] ='el nombre debe tener entre 4 y 50 caracteres, no se permiten numeros';
    }    
   
   if(!preg_match("/^[a-zA-Z\s]{4,50}$/",$apellido))
    {
        $errors[2]= 'el apellido debe tener entre 4 y 50 caracteres, no se permiten numeros';
    }
    

    if(!preg_match("/^[a-zA-Z0-9\s]{4,150}$/",$localidad))
    {
        $errors[3]='La ciudad no puede tener caracteres especiales, debe tener entre 4 y 150 caracteres';
    }
  
    

    if(preg_match("/\s/", $username) || strlen($username) < 4 || strlen($username) > 16){
        $errors[5]='el usuario no puede tener espacios y debe tener entre 4 y 16 caracteres';

    }else{        
      if(consulta_usuario($username)){
        $errors[5]='el usuario ya está en uso';
        if(verificar_usuario_administrador($username)){
            $errors[5] = 'el usuario es administrador';
        }
    }
    }


    if(isset($errors)){
        $errors['estado'] = 0;
        echo json_encode($errors);
        }
    else{    
            modificar_cliente($ci, $nombre, $apellido, $localidad, $fecha_nacimiento, $username);
            $result['estado'] = 1;
            echo json_encode($result);
    } 
?>
