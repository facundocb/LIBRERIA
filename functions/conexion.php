<?php 

$host = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "bdemt3grp02";


try{

    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user_db, $pass_db);
    //se define una conexion pdo
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    $error = $e->getMessage();
}



//funcion de registrar_usuario.php
function consulta_CI($ci){
    global $conn;
    $query = $conn->query("SELECT count(*) FROM persona WHERE CI='$ci'")->fetch();
    //count devuelve una sola fila con la cantidad, y con el fetch se guarda en un array

    $flag_exist = current($query);
    //current agarra el valor ACTUAL de un array, al tener 0 o 1 entonces actua como boolean
    return $flag_exist;
}

//funcion de registrar usuario.php
function consulta_usuario($user){
    global $conn;
    $query = $conn->query("SELECT count(*) FROM usuario WHERE USERNAME='$user'")->fetch();
    //count devuelve una sola fila con la cantidad, y con el fetch se guarda en un array

    $flag_exist = current($query);
    //current agarra el valor ACTUAL de un array, al tener 0 o 1 entonces actua como boolean
    return $flag_exist;
    }
        

function verificar_ban($user){
    global $conn;
    $query = $conn->query("SELECT count(*) from usuario_cliente where ESTADO='0' AND USERNAME='$user'")->fetch();
    $result = current($query);
    
    return $result;
}


function banear_cliente($user){
    global $conn;
    $query = $conn->prepare("UPDATE usuario_cliente SET ESTADO = '0' where USERNAME =?;");
    $query->execute([$user]);
 
}






//funcion de ingresar_usuario.php
function verificar_usuario_administrador($USERNAME){
    
    global $conn;
    $query = $conn->query("SELECT count(USERNAME) FROM usuario_admin where usuario_admin.USERNAME = '$USERNAME'")->fetch();
        //count devuelve una sola fila con la cantidad, y con el fetch se guarda en un array
    $flag_exist = current($query);
        //current agarra el valor ACTUAL de un array, al tener 0 o 1 entonces actua como boolean
    return $flag_exist;
        
    }




function consulta_cedula_administrador($ADMIN_CI){
    global $conn;
    $query = $conn->query("SELECT COUNT(persona.CI) from usuario inner join usuario_admin ON usuario_admin.USERNAME = usuario.USERNAME INNER JOIN persona ON persona.CI = '$ADMIN_CI' AND persona.CI = usuario.CI;
    ")->fetch();
        //count devuelve una sola fila con la cantidad, y con el fetch se guarda en un array
    $flag_exist = current($query);
        //current agarra el valor ACTUAL de un array, al tener 0 o 1 entonces actua como boolean
    return $flag_exist;
}

function insertar_admin($CI, $SUCURSAL, $CLAVE_SEGURIDAD){
    global $conn;
    $query = $conn->query("SELECT usuario.USERNAME, usuario.PASSWD from usuario inner join persona on persona.CI = '$CI' AND persona.CI = usuario.CI
    ")->fetch();

    $nuevo_usuario = $query['USERNAME'] . '__admin';
    $nueva_password = $query['PASSWD'] . '__admin';
    $PASSWD_HASH = password_hash($nueva_password, PASSWORD_DEFAULT);
    $CLAVE_SEGURIDAD_HASH = password_hash($CLAVE_SEGURIDAD, PASSWORD_DEFAULT);


    $insersion_usuario = $conn->prepare("INSERT INTO USUARIO(CI, USERNAME, PASSWD) values(?,?,?)");
    $insersion_usuario->execute([$CI,$nuevo_usuario, $PASSWD_HASH]);

    $insersion_admin = $conn->prepare("INSERT INTO USUARIO_ADMIN(USERNAME, SUCURSAL, CLAVE_SEGURIDAD) VALUES(?,?,?)");
    $insersion_admin->execute([$nuevo_usuario, $SUCURSAL, $CLAVE_SEGURIDAD_HASH]);


}


//ezeqiel puto.
//segunda prueba.
//xd


//funcion de verificacion.php

function verificacion_extra_admin($CLAVE_SEGURIDAD, $CI, $USERNAME){
    global $conn;
    $msj_return;
    $query = $conn->query("SELECT CLAVE_SEGURIDAD FROM usuario_admin INNER JOIN usuario ON usuario_admin.USERNAME = usuario.USERNAME INNER JOIN persona on persona.CI = '{$CI}' AND usuario_admin.USERNAME = '{$USERNAME}'")->Fetch();

    $flag_exist = false;
    if($query){
        if(password_verify($CLAVE_SEGURIDAD, $query['CLAVE_SEGURIDAD'])){
            $flag_exist = true;    
        }     
    }
 return $flag_exist;
 
}

//funcion para registrar_usuario.php y para add_user.php
function insertar_cliente($CI, $NOMBRE, $APELLIDO, $LOCALIDAD, $FECHA_NACIMIENTO, $USERNAME, $PASSWD){

    global $conn;
    // acá se hacen 3 inserciones, una a la tabla persona, una a la tabla usuario referenciando a la persona y una a usuario_cliente que referencia a usuario

    $insersion_persona = $conn->prepare("INSERT INTO persona(CI, NOMBRE, APELLIDO, LOCALIDAD, FECHA_NACIMIENTO) VALUES (?,?,?,?,?)");
    //se prepara para hacer la query con los datos como incognitas
    $insersion_persona->execute([$CI,$NOMBRE,$APELLIDO,$LOCALIDAD,$FECHA_NACIMIENTO]);
    //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas

    $PASSWD_HASH = password_hash($PASSWD, PASSWORD_DEFAULT);
    $insersion_usuario = $conn->prepare("INSERT INTO usuario(USERNAME, PASSWD, CI) VALUES (?,?,?)");
    //se prepara para hacer la query con los datos como incognitas
    $insersion_usuario->execute([$USERNAME,$PASSWD_HASH,$CI]);
    //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas

    //se prepara para hacer la query con los datos como incognitas
    $insersion_cliente = $conn->prepare("INSERT INTO usuario_cliente(USERNAME) VALUES (?)");
    //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas1
    $insersion_cliente->execute([$USERNAME]);            
}


//funcion para mod_book.php
function modificar_libro($NEW_NOM_LIBRO, $NEW_PRECIO_LIBRO, $NEW_DESCRIPCION_LIBRO, $NEW_STOCK_LIBRO, $NEW_AUTOR_LIBRO, $NEW_GENERO_LIBRO, $NEW_FECHA_PUBLICACION_LIBRO, $NEW_EDITORIAL_LIBRO, $ID_BUSCADA){
    global $conn;
    $consulta = "UPDATE libro SET NOM_LIBRO=?,PRECIO_LIBRO=?,DESCRIPCION_LIBRO=?,STOCK_LIBRO=?, AUTOR_LIBRO=?, GENERO_LIBRO=?, FECHA_PUBLICACION_LIBRO=?, EDITORIAL_LIBRO=? WHERE ID_LIBRO =?";
    $conn->prepare($consulta)->execute([$NEW_NOM_LIBRO, $NEW_PRECIO_LIBRO, $NEW_DESCRIPCION_LIBRO, $NEW_STOCK_LIBRO, $NEW_AUTOR_LIBRO, $NEW_GENERO_LIBRO, $NEW_FECHA_PUBLICACION_LIBRO, $NEW_EDITORIAL_LIBRO, $ID_BUSCADA]);

    echo 'libro modificado';
}

//funcion para mod_user.php
function modificar_cliente($CI, $NEW_NOMBRE, $NEW_APELLIDO, $NEW_LOCALIDAD, $NEW_FECHA_NACIMIENTO, $NEW_USERNAME){
    global $conn;

    $consulta_persona = "UPDATE persona SET NOMBRE=?,APELLIDO=?,LOCALIDAD=?,FECHA_NACIMIENTO=? WHERE CI =? ";
    $conn->prepare($consulta_persona)->execute([$NEW_NOMBRE, $NEW_APELLIDO, $NEW_LOCALIDAD, $NEW_FECHA_NACIMIENTO, $CI]);
    //la consulta se prepara y se ejecuta con los parametros correspondientes

    $consulta_usuario = "UPDATE usuario SET USERNAME=? WHERE CI =?";

    
    $conn->prepare($consulta_usuario)->execute([$NEW_USERNAME,$CI]);
    //aca hace lo mismo que arriba
    echo 'usuario ingresado';
    }

function consulta_estanteria_activa($username){
    global $conn;
    $query = $conn->query("SELECT ID_ESTANTERIA FROM estanteria WHERE USERNAME = '{$username}' AND ESTADO = '1' ");
    $flag_exist = $query->fetch();
    return $flag_exist;
    
}

function crear_estanteria($username){
    global $conn;
    $insert_estanteria = ("INSERT INTO estanteria (username, estado) VALUES (?, '1')");
    $conn->prepare($insert_estanteria)->execute([$username]);
}

function consulta_tiene_libro($id_libro, $estante){
    global $conn;
    $query = $conn->query("SELECT CANTIDAD FROM tiene where id_libro={$id_libro} AND id_estanteria = {$estante};");
    $flag_exist = $query->fetch();
    return $flag_exist;
}

function actualizar_cantidad_libro($cantidad, $id_libro, $id_estante ){
    global $conn;

    $query = "UPDATE tiene SET cantidad=? WHERE ID_LIBRO = ? AND ID_ESTANTERIA = ?";
    $conn->prepare($query)->execute([$cantidad, $id_libro, $id_estante ]);

}

function insertar_libro($cantidad, $id_libro, $id_estante){
    global $conn;
    $query = "INSERT INTO tiene(CANTIDAD, ID_LIBRO, ID_ESTANTERIA) values(?,?,?)";
    $conn->prepare($query)->execute([$cantidad,$id_libro,$id_estante]);


}





?>