<?php
    include("functions/conexion.php");
    $user = 'chito1212';
    echo $user;

    $id_estante = consulta_estanteria_activa($user);



    $libros = $conn->query("SELECT ID_LIBRO from tiene WHERE tiene.ID_ESTANTERIA = '{$id_estante[0]}'")->fetchAll();


    foreach ($libros as $libro) {
        echo '<br>';
        echo 'id: ' . $libro['ID_LIBRO'] . ' ,';
        echo '<br>';



     //   $update_tiene = $conn->query("UPDATE tiene SET SUBTOTAL = '{$subtotal}' WHERE ID_LIBRO='{$id}' AND ID_ESTANTERIA = '{$id_estante[0]}'");


    }


?>