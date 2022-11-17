<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 

    <title>Verificación</title>
</head>
    <body>
        <div id="contenedor">
           
            <form action="" method="post" id="verificacion" autocomplete="off">
                <h2>Verificá tu identidad</h2>
                <input type="text" name="clave_seguridad" placeholder="cédula de identidad">
                <input type="text" name="CI" id="ci" placeholder="ingresá la clave de seguridad">
                <input id="boton" type="submit" value="Ingresar" name="Ingresar">
                
            </form> 
   
                        
            <?php 
            session_start();
            $username =  $_SESSION['username'];
            $_SESSION['logued_as_admin'] = true;
            include('../functions/conexion.php');

            if(isset($_POST['Ingresar'])){
                $clave_seguridad = $_POST['clave_seguridad'];
                $ci = $_POST['CI'];

                if(verificacion_extra_admin( 'intento_de_clave','55054034',  'Super_root')){
                    
                    session_start();
                    $_SESSION['username'] = $username;
                    header("location:v_panel_admin_usuario.php");
                }
                else{
                    echo "<p id='error'>los datos no son correctos </p>";
                }
            }
            
            ?>  
        </div>
    </body>
</html>
