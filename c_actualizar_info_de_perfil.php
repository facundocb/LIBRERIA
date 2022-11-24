<?php


session_start();

include("functions/conexion.php");

$user = $_SESSION['username'];
$nom = $_POST['nombre'];
$ape = $_POST['apellido'];
$localidad = $_POST['localidad'];
$fecha_nac = $_POST['fecha_nac'];
$user_nuevo = $_POST['user'];
$clave = $_POST['clave'];
$conf_clave = $_POST['conf_clave'];



if(strlen($nom) < 2 || preg_match("/[^[:alpha:]]/",$nom)){
    $errors[0] ='El nombre no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
}

if(strlen($ape) < 2 || preg_match("/[^[:alpha:]]/",$ape)){
    $errors[1]= 'El apellido no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
    //apellido funciona igual que nombre, a mejorar: que se puedan usar espacios        
}

if(strlen($localidad) < 4 || preg_match("/[^[:word:]\s]/",$localidad)){
    $errors[2]='La ciudad no puede tener caracteres especiales';
     //esta vez uso word en vez de alpha por si le pinta poner un numero de calle o algo, igual no puede usar espacios asi que a mejorar
}



if($user_nuevo != $user){ //si el usuario es el mismo que tiene antes y no lo quiere cambiar no necesita hacer ninguna validacion

    if(strlen($user_nuevo) < 4 || preg_match("/\s/", $user_nuevo)){
        $errors[4]='EL NOMBRE DE USUARIO no puede contener espacios ni ser inferior a 4 carácteres';
    
    }else{
        if(consulta_usuario($user_nuevo)){
            $errors[4]='el user ya está en uso, elegí otro';
        }
    }
}


if(strlen($clave) < 8 || preg_match("/\s/", $clave)){
    $errors[5]='La contraseña no puede tener menos de 8 caracteres , y no puede tener espacios';

}

if(!$clave == $conf_clave){
    $errors[6]='las contraseñas no coinciden';
}


if(isset($errors)){
    $errors['estado'] = 0;
    echo json_encode($errors);
}else{

    $ci = consulta_CI_con_user($user); //no agarra la ci del post porque la pueden modificar, la agarra del user


    $fecha_nacimiento = $_POST['fecha_nac'];

    $hashed_pass = password_hash($clave, PASSWORD_DEFAULT);

    modificar_cliente( $ci[0], $nom, $ape, $localidad,$fecha_nacimiento, $user_nuevo, $hashed_pass);

    $result['estado'] = 1;
    $_SESSION['username'] = $user_nuevo;
    echo json_encode($result); //guardo el user nuevo en la sesión para que cuando se recargue ya quede ese usuario, y devuelvo un 1 en el estado para q este todo bien
}

?>