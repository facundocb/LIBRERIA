<?php 

    include("functions/conexion.php");

        $db = Conexion::abrir_conexion();
        //se conecta a la base de datos

        $username = $_POST['username'];
        $passwd = $_POST['passwd'];



        //se guardan en variables locales los post de usuario y password

        $sql = $db->query("SELECT PASSWD FROM usuario WHERE USERNAME='{$username}'")->Fetch();
        if(!$sql || !password_verify($passwd, $sql[0])){
            //si no se encuentra, o la verificacion no da, vuelve al inicio.
            header("location:index.php");
        }else{
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['passwd'] = $passwd;
            //si coincide, verifica si es cliente o administrador.
            if(!verificar_usuario_administrador($username)){
               header("location:index.php");            
            }else{
                header("location:administrador/v_verificacion.php");   
            }
        }
    
        

    
           

        
            


?>