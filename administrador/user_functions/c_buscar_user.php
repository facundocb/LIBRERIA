<?php
 include("../../functions/conexion.php");

$ci = $_POST['ci'];    


$query_datos = $conn->query("SELECT persona.CI, persona.NOMBRE, persona.APELLIDO, persona.LOCALIDAD, persona.FECHA_NACIMIENTO, usuario.USERNAME from persona INNER JOIN usuario ON usuario.CI = persona.CI AND persona.CI = '{$ci}'")->fetch();


if($query_datos){
    
    if(!verificar_usuario_administrador($query_datos['USERNAME'])){

        $datos = [ 
            'cedula' => $ci,
            'nombre' => $query_datos['NOMBRE'],
            'apellido' => $query_datos['APELLIDO'],
            'localidad' => $query_datos['LOCALIDAD'],
            'fecha_nacimiento' => $query_datos['FECHA_NACIMIENTO'],
            'username' =>$query_datos['USERNAME']
        ];    
        echo json_encode($datos);

    }else{
        echo 'es administrador'; 
    }


}else{
    echo ' no existe en la base de datos.';
    }


?>