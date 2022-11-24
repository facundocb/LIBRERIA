<?php
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];

    try{
        $db = Conexion::abrir_conexion();
        $query_existe_libro = $db->query("SELECT * FROM libro WHERE ID_LIBRO = {$ID}")->fetch();
        if($query_existe_libro){        
            $query_desban_libro = $db->query("UPDATE libro SET ESTADO = '1' WHERE ID_LIBRO = {$ID}");
            $result['estado'] = 1;
            echo json_encode($result);
        Conexion::cerrar_conexion();

        } else{
            $result['estado'] = 0;
            echo json_encode($result);
        }
    }catch(PDOException $e){
        $result['estado'] = 0;
        echo json_encode($result);
    }


?>