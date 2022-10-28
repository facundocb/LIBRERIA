<?php 
   
    include("../../functions/conexion.php");

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $localidad = $_POST['localidad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $username = $_POST['username'];


    if(!preg_match("/^[a-zA-Z\s]{4,50}$/",$nombre))
    {
        $errors[0] ='el nombre debe tener entre 4 y 50 caracteres, no se permiten numeros';
    }    
   
   if(!preg_match("/^[a-zA-Z\s]{4,50}$/",$apellido))
    {
        $errors[1]= 'el apellido debe tener entre 4 y 50 caracteres, no se permiten numeros';
    }
    

    if(!preg_match("/^[a-zA-Z0-9\s]{4,150}$/",$localidad))
    {
        $errors[2]='La ciudad no puede tener caracteres especiales, debe tener entre 4 y 150 caracteres';
    }
  
    

    if(preg_match("/\s/", $username)){
        $errors[4]='el usuario no puede tener espacios y debe tener entre 4 y 16 caracteres';

    }else{        
      if(consulta_usuario($username)){
        $errors[4]='el usuario ya está en uso';
      }
    }


    if(isset($errors)){
        echo 'el usuario no se pudo actualizar';
        echo '<br>';
        foreach($errors as $error){
        echo $error;
        echo '<br>';
        }
    }else{
        
    if(!verificar_usuario_administrador($username)){
        modificar_cliente($ci, $nombre, $apellido, $localidad, $fecha_nacimiento, $username);
        echo 'usuario ingresado';
    }else{
        echo 'el usuario es administrador, no se pudo actualizar';
    }
} 
?>
