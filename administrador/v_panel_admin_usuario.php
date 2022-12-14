<?php

session_start();

 $title = "panel admin";

    if(!isset($_SESSION['logued_as_admin'])){
        header("location:../index.php");
    }
    
    include("../functions/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos_admin.css">
    <link rel="stylesheet" href="estilos_admin_mobile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/f085d53cce.js" crossorigin="anonymous"></script> 
    <title><?php if(isset($title)){echo $title;} else{echo 'titulo';}?></title>
</head>

<body>



    <div id="header">
        <div id="logo">
        <img src="<?php echo $_SESSION['ruta'] ;  ?>/RECURSOS/logo.svg" alt="">
            <p>Mi mundo</p>            
        </div>

        <p id="nombre_admin"><?php echo $_SESSION['username']?></p>

          <p id='abrir_menu' onclick='abrir_menu()'><span class="material-icons">menu</span></p>
        <div id='container_botones'>
            <a href="<?php echo $_SESSION['ruta'] ;?>/administrador/v_panel_admin_libro.php">Libros</a>
            <a href="<?php echo $_SESSION['ruta'] ;?>/functions/c_cerrar_sesion.php">Cerrar sesion</a>
        </div>
    </div>

    <div id='menu_botones'>
            <a href="<?php echo $_SESSION['ruta'] ;  ?>/administrador/v_panel_admin_libro.php">Libros</a>
            <a href="<?php echo $_SESSION['ruta'] ;  ?>/functions/c_cerrar_sesion.php">Cerrar sesion</a>
        </div>

    <div id="buscador">
            <input type="text" id="buscar_libro_input" name="buscar_libro" placeholder="ingres?? el nombre del libro">
            <button id="boton_buscar" onclick="cargar_tabla()" ><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

    <div id="listado">
       <table id="result_consulta_usuario"></table>
    </div>






    <div id="funciones">
        <div id="insertar_usuario">
            <h2 class="titulo">agregar usuarios</h2>
            <div class="alerta" id="alerta_add"></div>
            <div id="form_insertar_usuario">
                <h4 class="subtitulo"   >Informaci??n Personal</h4>
                <input class="input_texto" type="text" name="add_nombre" id="add_nombre" placeholder="nombre">
                <div class="error_add"></div>
                <input class="input_texto" type="text" name="add_apellido" id="add_apellido" placeholder="apellido">
                <div class="error_add"></div>
                <input class="input_texto" type="text" name="add_ci" id="add_ci" placeholder="Cedula de identidad">
                <div class="error_add"></div>
                <input class="input_texto" type="text" name="add_localidad" id="add_localidad" placeholder="localidad">
                <div class="error_add"></div>
                <input class="input_texto" type="date" name="add_fecha_nacimiento" id="add_fecha_nacimiento" placeholder="fecha de nacimiento" value="2000-01-01">

                <div class="error_add"></div>
                <h4 class="subtitulo"   >Informacion del usuario</h4>

                <input class="input_texto" type="text" name="add_username" id="add_username" placeholder="Nombre de usuario">
                <div class="error_add"></div>
                <input class="input_texto" type="password" name="add_password" id="add_password" placeholder="Clave">
                <div class="error_add"></div>

                <button class="input_boton" id="insert_user_boton" onclick="insertar_user()">Ingresar usuario</button>
            </div>
        </div>

        <div id="funciones_chicas">

        <div id="banear_usuario">
            <h2 class="titulo">banear usuarios</h2>
            <div class="alerta" id='alerta_ban'></div>
                <div id="form_baneo_usuario">
                    <h4 class="subtitulo">Username del cliente a banear</h4>
                    <input class="input_texto" type="text" name="ban_username" id="ban_username" placeholder="Username">
                    <button class="input_boton" id="ban_user_boton" onclick="banear_user()">banear</button>
                </div>
            </div>

            <div id="agregar_administrador">
                <h2 class="titulo">asignar admin</h2>
                <div class="alerta" id="alerta_asign_adm"></div>
                <div id="form_asign_admin">
                    <input class="input_texto"  type="text" name="asign_CI" id="asign_CI" placeholder="cedula del usuario">
                    <div class="error_asign_adm"></div>
                    <input class="input_texto"  type="text" name="asign_sucursal" id="asign_sucursal" placeholder="sucursal">
                    <div class="error_asign_adm"></div>
                    <input class="input_texto"  type="text" name="asign_clave_seguridad" id="asign_clave_seguridad" placeholder="clave de seguridad">
                    <div class="error_asign_adm"></div>
                    <input class="input_texto"  type="text" name="asign_clave" id="asign_clave" placeholder="contrase??a">
                    <div class="error_asign_adm"></div>
                    <button class="input_boton" id="asign_admin_boton" onclick="asign_admin()">Asignar</button>
                </div>
            </div>
        </div>


        <div id="actualizar_usuario">
            <h2 class="titulo">actualizar informacion del usuario</h2>
                <div id="form_buscar_user_mod">
                        <div class="alerta" id="alerta_buscar"></div>
                        <h4 class="subtitulo">Cedula a buscar</h4>
                        <input class="input_texto"  type="text" name="CI_buscar" id="CI_buscar" placeholder="CI">
                        <button onclick="enviar_ci();" class="input_boton" >BUSCAR</button>
                        
                </div>
                
                <div id="form_modificar_user">
                    <h4 class="subtitulo" >Informaci??n Personal</h4>
                    <div class="alerta" id="alerta_upd"></div>


                    <input class="input_texto"  type="text" name="update_nombre" id="update_nombre" placeholder="nombre">
                    <div class="error_upd"></div>
                    <input class="input_texto"  type="text" name="update_ci" id="update_ci" placeholder="Cedula de identidad" disabled>
                    <div class="error_upd"></div>
                    <input class="input_texto"  type="text" name="update_apellido" id="update_apellido" placeholder="apellido">
                    <div class="error_upd"></div>
                    <input class="input_texto"  type="text" name="update_localidad" id="update_localidad" placeholder="localidad">
                    <div class="error_upd"></div>
                    <input class="input_texto" value="2000-01-01" type="date" name="update_fecha_nacimiento" id="update_fecha_nacimiento" placeholder="fecha de nacimiento">
                    <div class="error_upd"></div>

                    <h4 class="subtitulo" >Informacion del usuario</h4>
                    <input class="input_texto"   type="text" name="update_username" id="update_username" placeholder="Nombre de usuario">
                    <div class="error_upd"></div>
                    <input class="input_texto"   type="text" name="update_password" id="update_password" placeholder="contrase??a">
                    <div class="error_upd"></div>
                    <button class="input_boton" onclick="modificar_user();">Actualizar</button>

                </div>
            

        </div>

    </div>
</body>

<script src="script_user.js"></script>
