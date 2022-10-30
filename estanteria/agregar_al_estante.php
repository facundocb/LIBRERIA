<?php
    session_start();
    include("../functions/conexion.php");

    if(!isset($_SESSION['username'])){
        echo "<div class='error'> <span class='material-icons'>report_problem</span> <p class='error_texto'> No estas logueado!</p></div>"   ;
        
        die();
    }

    
    $cantidad = $_POST['cantidad'];
    if($cantidad < 1 ){
        echo "<div class='error'> <span class='material-icons'>report_problem</span> <p class='error_texto'>  sos chistoso, pelotudito?</p></div>"   ;
        die();
    }


    $user = $_SESSION['username'];
    $id_libro = $_POST['id_libro'];

    $id_estante = consulta_estanteria_activa($user);
    if(!$id_estante){
        crear_estanteria($user);    
    }
    else{
        $existe_libro = consulta_tiene_libro($id_libro, $id_estante[0]);

        if($existe_libro){
            actualizar_cantidad_libro($cantidad, $id_libro, $id_estante[0]);
            echo "<div class='ok'> <span class='material-icons'>done</span> <p class='ok_texto'> Se agregó el libro</p></div>";
        }
        else{
            insertar_libro($cantidad, $id_libro, $id_estante[0]);
            echo "<div class='ok'> <span class='material-icons'>done</span> <p class='ok_texto'> Se agregó el libro</p></div>";
        }
    }  
?>