<?php 

    include("../../functions/conexion.php");

    $ID_LIBRO = $_POST['ID'];
    $NOM_LIBRO = $_POST['nom_libro'];
    $DESCRIPCION_LIBRO = $_POST['descripcion_libro'];
    $PRECIO_LIBRO = $_POST['precio_libro'];
    $AUTOR_LIBRO = $_POST['autor_libro'];
    $GENERO_LIBRO = $_POST['genero_libro'];
    $STOCK_LIBRO = $_POST['stock_libro'];
    $FECHA_PUBLICACION = $_POST['fecha_publicacion_libro'];
    $EDITORIAL_LIBRO = $_POST['editorial_libro'];
    $errors;
    
    
    if(!preg_match('/^[a-zA-Z0-9\s]{4,70}$/', $NOM_LIBRO )){
        $errors[0] = 'el nombre debe tener entre 4 y 70 caracteres'; 
    }

    if(!preg_match('/[a-zA-Z0-9\s]/', $DESCRIPCION_LIBRO)){
        $errors[1] = 'la descripcion del libro debe tener entre 30 y 5000 caracteres';
    }

    if(!preg_match('/^\d{0,100}$/', $PRECIO_LIBRO) || 100 >  $PRECIO_LIBRO || 100000 < $PRECIO_LIBRO){
        $errors[2] = 'el precio del libro no es valido';
    }

    if(!preg_match('/^\d{0,10}$/', $STOCK_LIBRO) || 1 >  $STOCK_LIBRO || 100000 < $STOCK_LIBRO){
        $errors[3] = 'el stock del libro tiene que estar entre 0 y 100';
    }

    if(!preg_match('/^[a-zA-Z\s]{4,50}$/', $AUTOR_LIBRO)){
        $errors[4] = 'el autor no puede tener numeros o caracteres especiales.';
    }
    
    if(!preg_match('/^[a-zA-Z\s]{4,50}$/', $GENERO_LIBRO)){
        $errors[5] = 'el genero no puede tener numeros o caracteres especiales.';
    }
    if(!preg_match('/[a-zA-Z\s]/', $EDITORIAL_LIBRO)){
        $errors[6] = 'la editorial no puede tener numeros o caracteres especiales.';
    }

    if($_POST['fecha_publicacion_libro'] = '' || $_POST['fecha_publicacion_libro'] == ' '){
        $errors[7] = 'fecha no valida';        
    }


    

    if(!isset($errors)){
       modificar_libro($NOM_LIBRO, $PRECIO_LIBRO, $DESCRIPCION_LIBRO, $STOCK_LIBRO, $AUTOR_LIBRO, $GENERO_LIBRO, $FECHA_PUBLICACION,$EDITORIAL_LIBRO,  $ID_LIBRO);
        $result['estado'] = 1;
        echo json_encode($result);
    }else{
        $errors['estado'] = 0;
        echo json_encode($errors);

    }
?>