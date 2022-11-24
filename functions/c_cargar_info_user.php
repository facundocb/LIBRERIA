<?php 
include('conexion.php');

session_start();

$user = $_SESSION['username'];

try{
    $db = Conexion::abrir_conexion();
    $query_user = $db->query("SELECT persona.CI, persona.NOMBRE, persona.APELLIDO, persona.LOCALIDAD, persona.FECHA_NACIMIENTO, usuario.USERNAME, usuario.PASSWD from persona inner join usuario ON persona.CI = usuario.ci AND usuario.USERNAME = '{$user}';")->fetch();
    
    if($query_user){
        $datos_user = [
            'estado' => 1,
            'ci' => $query_user['CI'],
            'nom' => $query_user['NOMBRE'],
            'ape' => $query_user['APELLIDO'],
            'loc' => $query_user['LOCALIDAD'],
            'nac' => $query_user['FECHA_NACIMIENTO'],
            'pass' => $query_user['PASSWD'],
            'usr' => $query_user['USERNAME']
        ];
    
        echo json_encode($datos_user); //devuelve un objeto largo con un estado de uno, y la info del usuario
    }else{
        $datos_user = [
            'estado' => 0,
        ];
        echo json_encode($datos_user); //devuelve un objeto chikito con un estado en 0
    }
}catch(PDOException $e){
    echo "error en la consulta";
    die();
}
Conexion::cerrar_conexion();






?>