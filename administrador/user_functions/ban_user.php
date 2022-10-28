<?php 
include("../../functions/conexion.php");

    $username = $_POST['username'];
    $msj_return;


    if(!consulta_usuario($username)){
        $msj_return = 'el usuario que se buscaba en el sistema no existe'; 
    }
    else{
        if(verificar_usuario_administrador($username)){
            $msj_return = 'el usuario que se intentó eliminar era administrador.';
        }
        else{
            if(verificar_ban($username)){
                $msj_return = 'el usuario YA ESTABA BANEADO';
            }
            else{
                banear_cliente($username);
            $msj_return = 'usuario BANEADO, ELIMINADO, DESINTEGRADO, ANIQUILADO, DESTRUIDO, PULVERIZADO, REDUCIDO';  
            }
        }
        
    }
    

    echo $msj_return;


?>