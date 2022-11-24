<?php 
   
    include("../../functions/conexion.php");
    session_start();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    if(isset($_SESSION['ci'])){
        $ci = $_SESSION['ci'];
    }else{
        $ci = $_POST['ci'];
    }

    $localidad = $_POST['localidad'];
    if($_POST['fecha_nacimiento'] == ''){
        $errors[4] = 'fecha no valida';
    }else{
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
    }


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
  
    
    if($username != $_SESSION['user_viejo']){

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
    }

    if(strlen($pass) < 8 || preg_match("/\s/", $pass)){
        $errors[6]='La contraseña no puede tener menos de 8 caracteres , y no puede tener espacios';
 
    }



    if(isset($errors)){
        $errors['estado'] = 0;
        echo json_encode($errors);
        }
    else{   
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); 
            modificar_cliente($ci, $nombre, $apellido, $localidad, $fecha_nacimiento, $username, $hashed_pass);
            $result['estado'] = 1;
            echo json_encode($result);
    } 
?>
