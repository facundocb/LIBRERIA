<?php
    session_start();
    include("../functions/conexion.php");


    $cantidad = $_POST['cantidad'];
    $user = $_SESSION['username'];
    $id_libro = $_POST['id_libro'];

    $id_estante = consulta_estanteria_activa($user);

    if(!$id_estante){
        
        echo 'ahora existe estante, ';
        crear_estanteria($user);    
    
        
    }
    else{
        echo 'ya existe estante, ';
        $cantidad = consulta_tiene_libro($id_libro, $user);

        if($cantidad){
            var_dump($cantidad);
            actualizar_cantidad_libro($cantidad[0], $id_libro, $user);
            
            echo ',se actualizo la cantidad';
        }
        else{
            echo 'no tiene libro';
            //insertar_libro($cantidad, $id_libro, $user, $id_estante);
        }

        
    }

    
?>