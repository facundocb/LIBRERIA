<?php
    session_start();
    include("../functions/conexion.php");

    $user = $_SESSION['username'];

    $estanteria_activa = consulta_estanteria_activa($user)[0];
    
    $libros = $conn->query("SELECT ID_LIBRO from tiene WHERE tiene.ID_ESTANTERIA = '{$estanteria_activa}'")->fetchAll();

    $fecha = date('Y-m-d');

    $metodo_pago = $_POST['metodo_de_pago'];


    //    $compra = $conn->prepare("INSERT INTO realiza VALUES (?,?,?,?,?));
  //  $resultado = $compra->execute([])

/*
  $result = [
    'user'=>$user,
    'estan'=>$estanteria_activa,
    'libros'=>$libros,
    'fecha'=>$fecha,
    'met'=>$metodo_pago
  ];
*/

 /// echo $metodo_pago;
  //echo json_encode($result);

?>