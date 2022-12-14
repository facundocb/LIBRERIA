<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['ruta'] = "/LIBRERIA/"; //ESTA RUTA TIENE QUE ARRANCAR DESDE LA RAIZ DE APACHE HASTA EL DIRECTORIO EN EL Q NOS ENCONTRAMOS, ej:
    //si la libreria esta en una carpeta llamada programas, que esta en la raiz, seria /programas/LIBRERIA/"

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8 without BOM">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $_SESSION['ruta']?>/layout/estilos.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_SESSION['ruta'] ;  ?>/layout/mobil.css" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <script src="<?php echo $_SESSION['ruta'] ;  ?>/layout/scriptmobil.js"></script>
    <script src="https://kit.fontawesome.com/f085d53cce.js" crossorigin="anonymous"></script>
    <title><?php if(isset($title)){echo $title;} else{echo 'titulo';}?></title>


</head>
<body >
    
        <header id="header">
            
            <a href="<?php echo $_SESSION['ruta'] ;  ?>/index.php"><img id="logo" src="<?php echo $_SESSION['ruta'] ;  ?>/RECURSOS/logo.svg" alt="Mi mundo" ></a>

                <form action="<?php echo $_SESSION['ruta'] ;  ?>/v_busqueda_libros.php" method="get" id="formulario_busqueda">
                     <input id="buscador" type="text" placeholder="Buscar libro" name="nombre_busqueda">
                     <button id="boton_buscar" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                     <button id="boton_buscar_input" type="button" onclick="abririnput()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            <nav>
                <ul>
                    <li>
                    <span class="material-icons" onclick="abrir_menu()">   person</span>
                        
                        <button id="abridor" onclick="abrir_login()">
                        <?php 
                        if(isset($_SESSION['username']))
                            echo $_SESSION['username'];
                        else
                            echo 'Mi perfil';
                        ?>
                        </button>
                    </li> 

                    <li>
                        <span class="material-icons" onclick="abrir_estanteria()">shelves</span>
                        <button><a class='direccion_invisible' href="<?php echo $_SESSION['ruta'] ;  ?>estanteria/v_estanteria.php">Estanteria</a></button>
                    </li>

                </ul>
                <!-- nav del menu principal-->   
            </nav>
        </header>
        <nav id="navegador">

          <ul>
            <li>
                <a href="<?php echo $_SESSION['ruta'] ;  ?>/index.php">Libros</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="<?php echo $_SESSION['ruta'] ; ?>/v_busqueda_libros.php?nombre_busqueda=&filtro_genero=JUVENIL">Infantil y juvenil</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="#<?php echo $_SESSION['ruta']?>/index.php#novedades">Novedades</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="">Mas vendidos</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="<?php echo $_SESSION['ruta']?>/v_about_us.php">Nosotros</a>
            </li>
          </ul>
          <!-- barra d navegacion-->   
        </nav>
