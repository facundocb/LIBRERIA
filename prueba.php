<?php
    include("functions/conexion.php");



    
    $USERNAME = 'chito1212';
    
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT DIRECCION_IMG, ID_LIBRO FROM libro WHERE ID_LIBRO > 465")->FetchAll();
    

        foreach($query as $libro){
            echo "<br>";
            echo $libro['ID_LIBRO'] . ' con direccion: ' . $libro['DIRECCION_IMG'];
            $nueva_direccion = '/RECURSOS/libros/' . $libro['DIRECCION_IMG'];
            $id = $libro['ID_LIBRO'];

            //$sql = "UPDATE libro SET DIRECCION_IMG = '{$nueva_direccion}' WHERE ID_LIBRO = '{$id}'";

             //$nueva_query = $db->query($sql);

        }

        
        
    } catch(PDOException $e){
        echo 'error', $e->getMessage();
    }





?>