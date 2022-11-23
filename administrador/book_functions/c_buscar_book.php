<?php 
    include("../../functions/conexion.php");

    $ID = $_POST['ID'];

    if( !preg_match("/^\d{0,900}$/",$ID || $ID = '')){
        $result['estado'] = 0;
        $result[0] ='id no valida';
        
        echo json_encode($result);
        die();
    }

    try{
        $db = Conexion::abrir_conexion();

        $query_datos = $db->query("SELECT NOM_LIBRO, DESCRIPCION_LIBRO, PRECIO_LIBRO, STOCK_LIBRO, AUTOR_LIBRO, GENERO_LIBRO, EDITORIAL_LIBRO, FECHA_PUBLICACION_LIBRO FROM libro WHERE ID_LIBRO = '{$ID}';")->fetch();
    
        if($query_datos){
            $datos_libro = [
                'estado' => 1,
                0 => $ID,
                1 => $query_datos['NOM_LIBRO'],
                2 => $query_datos['DESCRIPCION_LIBRO'],
                3 => $query_datos['PRECIO_LIBRO'],
                4 => $query_datos['STOCK_LIBRO'],
                5 => $query_datos['AUTOR_LIBRO'],
                6 => $query_datos['GENERO_LIBRO'],
                7 => $query_datos['EDITORIAL_LIBRO'],
                8 => $query_datos['FECHA_PUBLICACION_LIBRO']
    
            ];
            echo json_encode($datos_libro);
        }else{
         $result['estado'] = 0;
         $result[0] = 'no se encontro en la bd';
         echo json_encode($result); 
        }
    }catch(PDOException $e){
        echo "error en la consulta";
        die();
    }
    Conexion::cerrar_conexion();
    




?>