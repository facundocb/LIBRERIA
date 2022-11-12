<?php
    include("functions/conexion.php");



    
    $USERNAME = 'chito1212';
    
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT CLAVE_SEGURIDAD FROM usuario_admin INNER JOIN usuario ON usuario_admin.USERNAME = usuario.USERNAME AND usuario_admin.USERNAME = '{$USERNAME}'")->Fetch();
    
        
        if($query){
            foreach($query as $compra){
                echo $compra['nom_libro'] . ' ' . $compra['fecha'] . $compra['subtotal'] . '<br>';
            }
            

        }
        
    } catch(PDOException $e){
        echo 'error';
    }





?>