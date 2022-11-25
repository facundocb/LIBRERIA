<?php 

class Conexion 
{
    public static $bd;
    public static $mysqli;
    
    private static $host = "localhost";
    private static $user_db = "root";
    private static $pass_db = "";
    private static $db_name = "bdemt3grp02";

    public static function abrir_conexion(){
        try{
            self::$bd = new PDO("mysql:host=" . self:: $host . ";dbname=" . self:: $db_name, self:: $user_db,self:: $pass_db);
            self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$bd;

        }catch(PDOException $e){
            echo 'hubo un error al conectarse a la bd';
        }
    }

    public static function cerrar_conexion(){
        self::$bd = null;
    }

    public static function abrir_mysqli(){
        self::$mysqli = new mysqli(self:: $host, self:: $user_db, self:: $pass_db, self:: $db_name);
        if(self::$mysqli){
            return self::$mysqli;
        }else{
            echo 'error';
        }
    }
    //la conexion a mysqli es para los archivos que se mandan por get y asi usar un mysqli_real_escape_string para evitar inyecciones


}

//funcion de registrar_usuario.php
function consulta_CI($ci){
        
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT CI FROM persona WHERE CI='$ci'");
        $flag_exist = $query->fetch(); 

        Conexion::cerrar_conexion();
        return $flag_exist; //devuelve la ci o un array vacío

    }catch(PDOException $e){
        echo "error en la consulta";
        die();
    }
    
}



function consulta_CI_con_user($user){
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT CI FROM usuario WHERE USERNAME = '{$user}'");
        $result = $query->fetch(); //devuelve la ci o un array vacio
        Conexion::cerrar_conexion();
        return $result;
    } catch(PDOException $e){
        echo "Error en la query";
    }
}


//funcion de registrar usuario.php
function consulta_usuario($user){
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT USERNAME FROM usuario WHERE USERNAME='$user'");
        $flag_exist = $query->fetch(); //devuelve el usuario o un array vacio
        Conexion::cerrar_conexion();
        return $flag_exist;
    }catch(PDOException $e){
        echo "error en la consulta";
        die();
    }

}
 
    
function actualizar_pass($ci, $pass){
    

    try{
        $db = Conexion::abrir_conexion();
        $username = $db->query("SELECT usuario_cliente.USERNAME FROM `usuario_cliente` INNER JOIN usuario ON usuario_cliente.USERNAME = usuario.USERNAME AND usuario.CI = '{$ci}';")->fetch();
        //guarda el user que tiene alguien con una cedula x 
        $update_user = $db->prepare("UPDATE usuario SET passwd = ? WHERE username = ?"); //prepara la consulta para guardar la nueva contraseña
        $update_user->execute([$pass, $username[0]]); //ejecuta con la pasada por parametros y el usuario del select de hace 3 lineas
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}



function verificar_ban($user){
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT USERNAME from usuario_cliente where ESTADO='0' AND USERNAME='$user'");
        $result = $query->fetch(); //devuelve el user del usuario baneado o un array vacio
        Conexion::cerrar_conexion();
        return $result;

    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }
}

function banear_cliente($user){
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->prepare("UPDATE usuario_cliente SET ESTADO = '0' where USERNAME =?;");
        $query->execute([$user]); //ejecuta el baneo con el usuario pasado por parametros
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    } 
}

function verificar_usuario_administrador($USERNAME){
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT USERNAME FROM usuario_admin where usuario_admin.USERNAME = '$USERNAME'");
        //hace la consulta
        $flag_exist = $query->fetch();
            //el fetch va a traer o un array vacio o el array con el usuario
        Conexion::cerrar_conexion();
        return $flag_exist;
            
    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }
}




function consulta_cedula_administrador($ADMIN_CI){
    try{
        $db = Conexion::abrir_conexion();

        $query = $db->query("SELECT persona.CI from usuario inner join usuario_admin ON usuario_admin.USERNAME = usuario.USERNAME INNER JOIN persona ON persona.CI = '$ADMIN_CI' AND persona.CI = usuario.CI;");
        $flag_exist = $query->fetch(); //devuelve array vacio o la ci del usuario
        Conexion::cerrar_conexion();
        return $flag_exist;

    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }
}

function insertar_admin($CI, $SUCURSAL, $CLAVE_SEGURIDAD, $PASSWD){
    


    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT usuario.USERNAME, usuario.PASSWD from usuario inner join persona on persona.CI = '$CI' AND persona.CI = usuario.CI")->fetch();
    
        $nuevo_usuario = $query['USERNAME'] . '_a';


        //el usuario y la contraseña del administrador es la misma que del cliente pero con un _a al final

        $insersion_usuario = $db->prepare("INSERT INTO usuario(CI, USERNAME, PASSWD) values(?,?,?)");
            $insersion_usuario->execute([$CI,$nuevo_usuario, $PASSWD]); //se ejecuta la consulta del nuevo usuario
    
        $insersion_admin = $db->prepare("INSERT INTO usuario_admin(USERNAME, SUCURSAL, CLAVE_SEGURIDAD) VALUES(?,?,?)");
        $insersion_admin->execute([$nuevo_usuario, $SUCURSAL, $CLAVE_SEGURIDAD]); //y se lo hace admin
        Conexion::cerrar_conexion();

    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}

//funcion de verificacion.php

function verificacion_extra_admin($CLAVE_SEGURIDAD, $CI, $USERNAME){
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT CLAVE_SEGURIDAD FROM usuario_admin INNER JOIN usuario ON usuario_admin.USERNAME = usuario.USERNAME INNER JOIN persona on persona.CI = '{$CI}' AND usuario_admin.USERNAME = '{$USERNAME}'")->fetch();
        $flag_exist = false;
      
        if($query){
            if(password_verify($CLAVE_SEGURIDAD, $query['CLAVE_SEGURIDAD'])){
                $flag_exist = true; //si la clave es igual a la clave de la query entonces retorna verdadero         
            }     
        }
        Conexion::cerrar_conexion();
        return $flag_exist;
    }catch(PDOException $e){
    Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }
 
}

function insertar_cliente($CI, $NOMBRE, $APELLIDO, $LOCALIDAD, $FECHA_NACIMIENTO, $USERNAME, $PASSWD){


    try{
        $db = Conexion::abrir_conexion();
        // acá se hacen 3 inserciones, una a la tabla persona, una a la tabla usuario referenciando a la persona y una a usuario_cliente que referencia a usuario
    
        $insersion_persona = $db->prepare("INSERT INTO persona(CI, NOMBRE, APELLIDO, LOCALIDAD, FECHA_NACIMIENTO) VALUES (?,?,?,?,?)");
        //se prepara para hacer la query con los datos como incognitas
        $insersion_persona->execute([$CI,$NOMBRE,$APELLIDO,$LOCALIDAD,$FECHA_NACIMIENTO]);
        //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas
    
        $PASSWD_HASH = password_hash($PASSWD, PASSWORD_DEFAULT);
        $insersion_usuario = $db->prepare("INSERT INTO usuario(USERNAME, PASSWD, CI) VALUES (?,?,?)");
        //se prepara para hacer la query con los datos como incognitas
        $insersion_usuario->execute([$USERNAME,$PASSWD_HASH,$CI]);
        //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas
    
        //se prepara para hacer la query con los datos como incognitas
        $insersion_cliente = $db->prepare("INSERT INTO usuario_cliente(USERNAME) VALUES (?)");
        //ejecuta la consulta CON los parámetros EN EL ORDEN de las incognitas1
        $insersion_cliente->execute([$USERNAME]);            
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta" . $e->getMessage();
        die();
    }
}


function modificar_libro($NEW_NOM_LIBRO, $NEW_PRECIO_LIBRO, $NEW_DESCRIPCION_LIBRO, $NEW_STOCK_LIBRO, $NEW_AUTOR_LIBRO, $NEW_GENERO_LIBRO, $NEW_FECHA_PUBLICACION_LIBRO, $NEW_EDITORIAL_LIBRO, $ID_BUSCADA){


    try{
        $db = Conexion::abrir_conexion();
        $consulta =$db->prepare("UPDATE libro SET NOM_LIBRO=?,PRECIO_LIBRO=?,DESCRIPCION_LIBRO=?,STOCK_LIBRO=?, AUTOR_LIBRO=?, GENERO_LIBRO=?, FECHA_PUBLICACION_LIBRO=?, EDITORIAL_LIBRO=? WHERE ID_LIBRO =?");
        $consulta->execute([$NEW_NOM_LIBRO, $NEW_PRECIO_LIBRO, $NEW_DESCRIPCION_LIBRO, $NEW_STOCK_LIBRO, $NEW_AUTOR_LIBRO, $NEW_GENERO_LIBRO, $NEW_FECHA_PUBLICACION_LIBRO, $NEW_EDITORIAL_LIBRO, $ID_BUSCADA]);
        //se ejecuta la insersion
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
        Conexion::cerrar_conexion();
        echo "error en la consulta" . $e->getMessage();
        die();
    }

}


function modificar_cliente($CI, $NEW_NOMBRE, $NEW_APELLIDO, $NEW_LOCALIDAD, $NEW_FECHA_NACIMIENTO, $NEW_USERNAME, $NEW_PASSWORD){
    
    try{
        $db = Conexion::abrir_conexion();
        $consulta_persona = $db->prepare("UPDATE persona SET NOMBRE=?,APELLIDO=?,LOCALIDAD=?,FECHA_NACIMIENTO=? WHERE CI =? ");
        $consulta_persona->execute([$NEW_NOMBRE, $NEW_APELLIDO, $NEW_LOCALIDAD, $NEW_FECHA_NACIMIENTO, $CI]);
        //primero se cambian los atributos de la persona
    
        $consulta_usuario = $db->prepare("UPDATE usuario SET USERNAME=?, PASSWD=? WHERE CI =?");
        $consulta_usuario->execute([$NEW_USERNAME, $NEW_PASSWORD, $CI]);
        //y luego los cambian en el usuario
        Conexion::cerrar_conexion();
    }catch(PDOException $e){
    Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }
}

function consulta_estanteria_activa($username){
    
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT ID_ESTANTERIA FROM estanteria WHERE USERNAME = '{$username}' AND ESTADO = '1' ");
        $flag_exist = $query->fetch(); //esto devuelve la estanteria o un array vacio
    Conexion::cerrar_conexion();
        return $flag_exist;
    }catch(PDOException $e){
    Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}

function crear_estanteria($username){
    try{
        $db = Conexion::abrir_conexion();

        $insert_estanteria = $db->prepare("INSERT INTO estanteria (username, estado) VALUES (?, '1')");
        $insert_estanteria->execute([$username]); //crea una estanteria activa con la id del usuario
    Conexion::cerrar_conexion();

    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }

}

function inhabilitar_estante($id_estante){
    

    try{
        $db = Conexion::abrir_conexion();

        $update_estanteria = $db->prepare("UPDATE estanteria SET ESTADO = 0 WHERE ID_ESTANTERIA = ?");
        $update_estanteria->execute([$id_estante]); //ejecuta el update
    Conexion::cerrar_conexion();
    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }
}



function consulta_tiene_libro($id_libro, $estante){
    try{

        $db = Conexion::abrir_conexion();
        $query = $db->query("SELECT CANTIDAD FROM tiene where id_libro={$id_libro} AND id_estanteria = {$estante};");

        $flag_exist = $query->fetch(); //devuelve un arr vacio o la cantidad
    Conexion::cerrar_conexion();

        return $flag_exist;

    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }
}

function actualizar_cantidad_libro($cantidad, $id_libro, $id_estante ){

    try{
        $db = Conexion::abrir_conexion();
        $query = $db->prepare("UPDATE tiene SET cantidad=? WHERE ID_LIBRO = ? AND ID_ESTANTERIA = ?");
        $query->execute([$cantidad, $id_libro, $id_estante ]); //actualiza la cantidad
    Conexion::cerrar_conexion();
        
    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
       die();
    }

}


function insertar_libro($cantidad, $id_libro, $id_estante){

    try{
        $db = Conexion::abrir_conexion();
        $subtotal = calcular_subtotal($id_libro, $cantidad);
        $query = $db->prepare("INSERT INTO tiene(CANTIDAD, ID_LIBRO, ID_ESTANTERIA, SUBTOTAL ) values(?,?,?,?)");
        $query->execute([$cantidad,$id_libro,$id_estante, $subtotal]);
    Conexion::cerrar_conexion();

    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }
}

function borrar_libro_del_carrito($id_libro, $id_estante){
    try{
        $db = Conexion::abrir_conexion();
        $query = $db->prepare("DELETE FROM tiene WHERE ID_LIBRO = ? AND ID_ESTANTERIA = ?");
        $query->execute([$id_libro, $id_estante]);
        Conexion::cerrar_conexion();

    } catch(PDOException $e){
        echo "Error en la query";
    }


}


function calcular_subtotal($id_libro, $cantidad){
    try{
        $db = Conexion::abrir_conexion();
        $precio_individual = $db->query("SELECT PRECIO_LIBRO from libro where ID_LIBRO = {$id_libro}")->fetch();
        $subtotal = $precio_individual[0] * $cantidad;
        Conexion::cerrar_conexion();
        return $subtotal;
    }catch(PDOException $e){
    Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}

function compra($user, $estante, $metodo_pago){

    try{
        $db = Conexion::abrir_conexion();
        $libros = $db->query("SELECT ID_LIBRO from tiene WHERE tiene.ID_ESTANTERIA = '{$estante}'")->fetchAll();
        //cuenta todos los libros que estan en la estanteria

        foreach($libros as $libro){
            $realiza_insert = $db->prepare("INSERT INTO realiza(ID_ESTANTERIA, ID_LIBRO, USERNAME, FECHA, METODO_DE_PAGO) VALUES (?,?,?,now(),?)");
            
            $realiza_insert->execute([$estante, $libro['ID_LIBRO'], $user, $metodo_pago]);
            //por cada libro, que se haga una insersión a realiza
            quitar_stock($libro['ID_LIBRO'], $estante); // y el stock que se quite
        }
        inhabilitar_estante($estante); //luego que se quite el estante
    Conexion::cerrar_conexion();

    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }
    Conexion::cerrar_conexion();
}

function quitar_stock($id_libro, $estante){
    
    try{
        $db = Conexion::abrir_conexion();

        $query_cantidad = $db->query("SELECT tiene.CANTIDAD FROM tiene WHERE id_libro= '{$id_libro}' AND id_estanteria = '{$estante}'")->fetch();
    
        $query_stock = ver_stock($id_libro);
    
        $cantidad_actualizada = $query_stock[0] - $query_cantidad[0];
    
        $update_stock = $db->prepare( "UPDATE libro SET stock_libro = ? WHERE id_libro = ?");
      
        $update_stock->execute([$cantidad_actualizada, $id_libro]);
        Conexion::cerrar_conexion();

    }catch(PDOException $e){

        Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}

function ver_stock($id_libro){
  
    try{
        $db = Conexion::abrir_conexion();
        $query_stock = $db->query("SELECT STOCK_LIBRO FROM libro WHERE id_libro= '{$id_libro}'")->fetch();
        Conexion::cerrar_conexion();
        return $query_stock;
    }catch(PDOException $e){
    Conexion::cerrar_conexion();
        echo "error en la consulta";
        die();
    }

}
function cargar_historial_de_compras($user){
    try{
        $db = Conexion::abrir_conexion();

        $query = $db->query("SELECT * FROM historial_de_compras WHERE username = '{$user}'")->fetchAll();

        Conexion::cerrar_conexion();
        return $query;
    }catch(PDOException $e){
    Conexion::cerrar_conexion();

        echo "error en la consulta";
        die();
    }
    
}


?>