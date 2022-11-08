<?php
    session_start();
    include("../functions/conexion.php");

    $user = $_SESSION['username'];

    $estanteria_activa = consulta_estanteria_activa($user)[0];
    

    $fecha = date('Y-m-d');

    $metodo_pago = $_POST['metodo_de_pago'];

    compra($user, $estanteria_activa, $metodo_pago);

?>