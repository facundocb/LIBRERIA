<?php 
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];
    try{
        $db = Conexion::abrir_conexion();

        $query_datos = $db->query("SELECT NOM_LIBRO, DESCRIPCION_LIBRO, PRECIO_LIBRO, STOCK_LIBRO, AUTOR_LIBRO, GENERO_LIBRO, EDITORIAL_LIBRO, FECHA_PUBLICACION_LIBRO FROM libro WHERE ID_LIBRO = '{$ID}';")->fetch();
    
        if($query_datos){
            $datos_libro = [
                'id_libro' => $ID,
                'nom_libro' => $query_datos['NOM_LIBRO'],
                'descripcion_libro' => $query_datos['DESCRIPCION_LIBRO'],
                'precio_libro' => $query_datos['PRECIO_LIBRO'],
                'stock_libro' => $query_datos['STOCK_LIBRO'],
                'autor_libro' => $query_datos['AUTOR_LIBRO'],
                'genero_libro' => $query_datos['GENERO_LIBRO'],
                'editorial_libro' => $query_datos['EDITORIAL_LIBRO'],
                'fecha_publicacion_libro' => $query_datos['FECHA_PUBLICACION_LIBRO']
    
            ];
            echo json_encode($datos_libro);
        }else{
            echo 'no se encontraron libros';
        }
    }catch(PDOException $e){
        echo "error en la consulta";
        die();
    }
    Conexion::cerrar_conexion();
    




?>