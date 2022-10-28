<?php 

    include("functions/conexion.php");

        global $conn;
        //se conecta a la base de datos

        $username = $_POST['username'];
        $passwd = $_POST['passwd'];



        //se guardan en variables locales los post de usuario y password

        $sql = $conn->query("SELECT PASSWD FROM usuario WHERE USERNAME='{$username}'")->Fetch();
        if(!$sql || !password_verify($passwd, $sql[0])){
            header("location:index.php");
        }else{
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['passwd'] = $passwd;
            if(!verificar_usuario_administrador($username)){
               header("location:index.php");            
            }else{
                header("location:administrador/verificacion.php");   
            }
        }
    
        

    
           

        
            


?>