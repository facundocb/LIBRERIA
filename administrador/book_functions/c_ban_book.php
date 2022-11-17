<?php
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];

    try{
        $db = Conexion::abrir_conexion();
        $query_existe_libro = $db->query("SELECT * FROM libro WHERE ID_LIBRO = {$ID}")->fetch();
        if($query_existe_libro){
            
            $query_ban_libro = $conn->query("UPDATE libro SET ESTADO = '0' WHERE ID_LIBRO = {$ID}");
            echo 'el libro fue baneado.';
        Conexion::cerrar_conexion();
        } else{
            echo 'el libro no existe';
        }
    }catch(PDOException $e){
        echo "Error";
    }


?>