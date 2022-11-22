<?php 

session_start();
include("../../functions/conexion.php");

    $username = $_POST['username'];
    $msj_return;


    if(!consulta_usuario($username)){
        $resultado['estado'] = 0;
        $resultado[0] = 'el usuario que se buscaba en el sistema no existe'; 
        echo json_encode($resultado);
    }
    else{
        if(verificar_usuario_administrador($username)){
            $resultado['estado'] = 0;
            $resultado[0] = 'el usuario que se intentó eliminar era administrador.';
            echo json_encode($resultado);
        }
        else{
            if(verificar_ban($username)){
                $resultado['estado'] = 0;
                $resultado[0] = 'el usuario ya estaba baneado';
                echo json_encode($resultado);
            }
            else{
                banear_cliente($username);
                $resultado['estado'] = 1;
                $resultado[0] = 'usuario baneado correctamente';  
                echo json_encode($resultado);
            }

        }
        
    }
    



?>