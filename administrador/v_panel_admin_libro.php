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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f085d53cce.js" crossorigin="anonymous"></script> 
    <title><?php if(isset($title)){echo $title;} else{echo 'titulo';}?></title>
</head>

<body>
    <div id="header">
        <div id="logo">

            <img src="../RECURSOS/logo.svg" alt="">
            <p>Mi mundo</p>            
        </div>

        <p id="nombre_admin"><?php echo $_SESSION['username']?> </p>
        <p id='abrir_menu' onclick='abrir_menu()'><span class="material-icons">menu</span></p>
        <div id='container_botones'>
            <a href="v_panel_admin_usuario.php">Usuarios</a>
            <a href="../functions/c_cerrar_sesion.php">Cerrar sesion</a>
        </div>
    </div>
    <div id='menu_botones'>
            <a href="<?php echo $_SESSION['ruta'] ;  ?>/administrador/v_panel_admin_usuario.php">Usuarios</a>
            <a href="<?php echo $_SESSION['ruta'] ;  ?>/functions/c_cerrar_sesion.php">Cerrar sesion</a>
        </div>

    <div id="buscador">
            <input type="text" id="buscar_libro_input" name="buscar_libro" placeholder="ingresá el nombre del libro">
            <button id="boton_buscar" onclick="cargar_tabla()" ><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

   <div id="alerta"></div>

    <div id="listado"></div>

    <div id="funciones">

        <div id="contenedor_grande">
            <h2 class="titulo">Agregar libro</h2>
            <div class="alerta" id="alerta_add"></div>
            <div id="form_agregar_libro">

                <input type="text" name="nom_libro"  class="input_texto" placeholder="Nombre del libro" >
                <div class="error_add"></div>
                <input type="text" name="descripcion_libro" class="input_texto_descripcion" placeholder="Descripcion" >
                <div class="error_add"></div>
                <input type="text" name="precio_libro"  class="input_texto" placeholder="Precio" >
                <div class="error_add"></div>
                <input type="text" name="stock_libro" class="input_texto" placeholder="stock actual" >
                <div class="error_add"></div>
                <input type="file" id="imagen_libro"  accept="img/*" class="input_imagen">
                <label class='label_imagen' for="imagen_libro"> Selecciona una imagen</label>
                <div class="error_add"></div>
                <input type="text" name="autor_libro"  class="input_texto" placeholder="autor">
                <div class="error_add"></div>
                <input type="text" name="genero_libro" class="input_texto" placeholder="genero">
                <div class="error_add"></div>
                <label for="fecha_publicacion" class='subtitulo'>Fecha de publicacion:</label>
                <input type="date" name="fecha_publicacion" class="input_texto" value="2000-01-01">
                <div class="error_add"></div>
                <input type="text" name="editorial_libro" class="input_texto" placeholder="editorial">
                <div class="error_add"></div>
               <button class="input_boton" onclick="insertar_libro()">Agregar libro</button>
            </div>
            
            <div id="cambiar_estado_libro">
                <h2 class="titulo">Estado del libro</h2>
                <h4 class="subtitulo">ID del libro </h4>    
                <div id="form_cambiar_estado_libro">
                    <input class="input_texto" type="text" name="ID_cambiar_estado" id="ID_cambiar_estado">
                    <button class="input_boton" onclick="banear_libro()">Inhabilitar Libro</button>
                    <button class="input_boton" onclick="desbanear_libro()">Habilitar libro</button>
                </div>
            </div>
        </div>




        <div id="modificar_libro">
        <h2 class="titulo">Modificar datos del libro</h2> 

            <div id="form_buscar_libro_mod">
                <h4 class='subtitulo'>ID del libro</h4>
                <div class="alerta" id='alerta_buscar'></div>
                <input type="text" name="buscarID" id="buscarID" class="input_texto">

                <button class="input_boton" onclick="enviar_ID()">buscar libro</button>
            </div>

            <div id="form_modificar_datos_libro">

                <div class="alerta" id="alerta_mod"></div>
                <h4 class="subtitulo">Datos del libro</h4>
                <input type="text" name="id_libro" class="input_texto" placeholder="ID del libro" disabled>
                <input type="text" name="nom_libro" class="input_texto" placeholder="Nombre del libro" >
                <div class="error_mod"></div>
                <input type="text" name="descripcion_libro" class="input_texto_descripcion" placeholder="Descripcion" >
                <div class="error_mod"></div>
                <input type="text" name="precio_libro" class="input_texto" placeholder="Precio" >
                <div class="error_mod"></div>
                <input type="text" name="stock_libro" class="input_texto" placeholder="stock actual" >
                <div class="error_mod"></div>
                <input type="text" name="autor_libro" class="input_texto" placeholder="autor">
                <div class="error_mod"></div>
                <input type="text" name="genero_libro" class="input_texto" placeholder="genero">   
                <div class="error_mod"></div>
                <input type="text" name="editorial_libro" class="input_texto" placeholder="editorial">
                <div class="error_mod"></div>
                <input type="date" value="2000-01-01"name="fecha_publicacion" class="input_texto" placeholder="fecha_publicacion">
                <div class="error_mod"></div>
                <button class="input_boton" onclick="modificar_libro()">Modificar libro</button>
            </div>


        </div>

    </div>





</body>
<script src="script_libro.js"></script>
