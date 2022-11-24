<?php
 include("../../functions/conexion.php");
session_start();
$ci = $_POST['ci'];    

try{

    $db = Conexion::abrir_conexion();
    
    $query_datos = $db->query("SELECT persona.CI, persona.NOMBRE, persona.APELLIDO, persona.LOCALIDAD, persona.FECHA_NACIMIENTO, usuario.USERNAME from persona INNER JOIN usuario ON usuario.CI = persona.CI AND persona.CI = '{$ci}'")->fetch();
    
    
    if($query_datos){
        
        if(!verificar_usuario_administrador($query_datos['USERNAME'])){
    
            $datos = [ 
                'estado' => 1,
                0 => $query_datos['NOMBRE'],
                1 => $ci,
                2 => $query_datos['APELLIDO'],
                3 => $query_datos['LOCALIDAD'],
                4 => $query_datos['FECHA_NACIMIENTO'],
                5 =>$query_datos['USERNAME']
            ];   
             $_SESSION['user_viejo'] = $query_datos['USERNAME'];
             $_SESSION['ci'] = $ci;
            echo json_encode($datos);
    
        }else{
            $datos['estado']= 0;
            $datos[0] = 'es un administrador';
            echo json_encode($datos);
        }
    
    
    }else{
        $datos['estado']= 0;
        $datos[0] = 'no existe en la base de datos';
        echo json_encode($datos);
    }

}catch(PDOException $e){
    echo "error en la consulta";
    die();
}
Conexion::cerrar_conexion();
   

?>