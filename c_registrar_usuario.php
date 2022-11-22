<?php

    $NOMBRE = $_POST['nom'];
    $APELLIDO = $_POST['ape'];
    $LOCALIDAD = $_POST['local'];
    $CI = $_POST['ci'];
    if(!isset($_POST['fecha_nac'])){

        $FECHA_NACIMIENTO = $_POST['fecha_nac'];
    }else{
        $errors[4] = 'fecha no valida';        
    }
    $USERNAME = $_POST['user'];
    $PASSWORD = $_POST['pass'];
    $CONFIRMAR_PASSWORD = $_POST['conf_pass'];



    if(strlen($NOMBRE) < 2 || preg_match("/[^[:alpha:]]/",$NOMBRE)){
        $errors[0] ='El nombre no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
    }

    if(strlen($APELLIDO) < 2 || preg_match("/[^[:alpha:]]/",$APELLIDO)){
        $errors[1]= 'El apellido no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
        //apellido funciona igual que nombre, a mejorar: que se puedan usar espacios        
    }

    if(strlen($LOCALIDAD) < 4 || preg_match("/[^[:word:]\s]/",$LOCALIDAD)){
        $errors[2]='La ciudad no puede tener caracteres especiales';
         //esta vez uso word en vez de alpha por si le pinta poner un numero de calle o algo, igual no puede usar espacios asi que a mejorar
    }

    if(strlen($CI) != 8 || preg_match("/[^[:digit:]]/",$CI)){
        $errors[3]='Ingresá la cedula sin puntos ni guiones(Ej: 1.234.567-8 ingresá 12345678)';
        // digit sirve para los numeros, un alfabetico o simbolo no sirve

    }else{ 
        if(consulta_CI($CI)){
            $errors[3]="La CI ya existe";
        }
    }

    

    if(strlen($USERNAME) < 4 || preg_match("/\s/", $USERNAME)){
        $errors[5]='EL NOMBRE DE USUARIO no puede contener espacios ni ser inferior a 4 carácteres';

    }else{
        if(consulta_usuario($USERNAME)){
            $errors[5]='el user ya está en uso, elegí otro';
        }
    }

    if(strlen($PASSWORD) < 8 || preg_match("/\s/", $PASSWORD)){
        $errors[6]='La contraseña no puede tener menos de 8 caracteres , y no puede tener espacios';
 
    }
    
    if(!$PASSWORD == $CONFIRMAR_PASSWORD){
        $errors[7]='las contraseñas no coinciden';
    }


    if(isset($errors)){
        $errors['estado'] = 0;
        echo json_encode($errors);
    }
    else{
        $errors['estado'] = 1;
        echo json_encode($errors);
    }






?>