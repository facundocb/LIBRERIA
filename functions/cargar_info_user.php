<?php 
include('conexion.php');

session_start();

$user = $_SESSION['username'];

$query_user = $conn->query("SELECT persona.CI, persona.NOMBRE, persona.APELLIDO, persona.LOCALIDAD, usuario.USERNAME, usuario.PASSWD from persona inner join usuario ON persona.CI = usuario.ci AND usuario.USERNAME = '{$user}';")->fetch();

if($query_user){
    $datos_user = [
        'ci' => $query_user['CI'],
        'nom' => $query_user['NOMBRE'],
        'ape' => $query_user['APELLIDO'],
        'loc' => $query_user['LOCALIDAD'],
        'pass' => $query_user['PASSWD'],
        'usr' => $query_user['USERNAME']
    ];

    echo json_encode($datos_user);
}else{
    echo 'aa';
}




?>