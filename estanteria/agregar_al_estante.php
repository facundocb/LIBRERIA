<?php
    session_start();
    include("../functions/conexion.php");

    if(!isset($_SESSION['username'])){
        echo 'no estas logueado, salame';
        die();
    }

    
    $cantidad = $_POST['cantidad'];

    if($cantidad < 1){
        echo 'sos chistoso';
        die();
    }


    $user = $_SESSION['username'];
    $id_libro = $_POST['id_libro'];

    $id_estante = consulta_estanteria_activa($user);
    if(!$id_estante){
        
        echo 'ahora existe estante, ';
        crear_estanteria($user);    
            
    }
    else{
        echo 'ya existe estante, ';
        $existe_libro = consulta_tiene_libro($id_libro, $id_estante[0]);

        if($existe_libro){
            actualizar_cantidad_libro($cantidad, $id_libro, $id_estante[0]);
            
            echo ' se actualizo la cantidad';
        }
        else{
            insertar_libro($cantidad, $id_libro, $id_estante[0]);
            echo 'ahora tiene libro';
        }
    }  
?>