<?php 
include('conexion.php');

session_start();

$user = $_SESSION['username'];

try{
    $db = Conexion::abrir_conexion();
    $query_user = $db->query("SELECT persona.CI, persona.NOMBRE, persona.APELLIDO, persona.LOCALIDAD, usuario.USERNAME, usuario.PASSWD from persona inner join usuario ON persona.CI = usuario.ci AND usuario.USERNAME = '{$user}';")->fetch();
    
    if($query_user){
        $datos_user = [
            'estado' => 1,
            'ci' => $query_user['CI'],
            'nom' => $query_user['NOMBRE'],
            'ape' => $query_user['APELLIDO'],
            'loc' => $query_user['LOCALIDAD'],
            'pass' => $query_user['PASSWD'],
            'usr' => $query_user['USERNAME']
        ];
    
        echo json_encode($datos_user);
    }else{
        $datos_user = [
            'estado' => 0,
        ];
        echo json_encode($datos_user);
    }
}catch(PDOException $e){
    echo "error en la consulta";
    die();
}
Conexion::cerrar_conexion();






?>