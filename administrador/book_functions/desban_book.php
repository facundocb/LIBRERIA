<?php
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];

    $query_existe_libro = $conn->query("SELECT * FROM LIBRO WHERE ID_LIBRO = {$ID}")->fetch();
    if($query_existe_libro){
        
        $query_ban_libro = $conn->query("UPDATE LIBRO SET ESTADO = '1' WHERE ID_LIBRO = {$ID}");
        echo 'el libro fue habilitado.';

    } else{
        echo 'el libro no existe';
    }


?>