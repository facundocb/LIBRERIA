<?php
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];


    try{
        $db = Conexion::abrir_conexion();
        $query_existe_libro = $db->query("SELECT * FROM libro WHERE ID_LIBRO = {$ID}")->fetch();
        if($query_existe_libro){
            
            $query_ban_libro = $db->query("UPDATE libro SET ESTADO = '1' WHERE ID_LIBRO = {$ID}");
            echo 'el libro fue habilitado.';
    
        } else{
            echo 'el libro no existe';
        }
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
        echo "Error en la consulta";
    }


?>