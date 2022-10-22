<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/LIBRERIA/layout/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/LIBRERIA/layout/mobil.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <script src="/LIBRERIA/layout/script.js"></script>
    <script src="/LIBRERIA/layout/scriptmobil.js"></script>
    <script src="https://kit.fontawesome.com/f085d53cce.js" crossorigin="anonymous"></script>
    <title><?php if(isset($title)){echo $title;} else{echo 'titulo';}?></title>


</head>
<body>
    
        <header id="header">
            
            <a href="/LIBRERIA/index.php"><img id="logo" src="/LIBRERIA/RECURSOS/logo.png" alt="Mi mundo" ></a>

                <form action="/LIBRERIA/busqueda_libros.php" method="get" id="formulario_busqueda">
                     <input id="buscador" type="text" placeholder="buscar libro" name="nombre_libro_buscado">
                     <button id="boton_buscar" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                     <button id="boton_buscar_input" type="button" onclick="abririnput()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            <nav>
                <ul>
                    <li>
                        <i class="fa-solid fa-user-large"></i>
                        <p id="abridor_menu" onclick="abrir_menu()">&#9776;</p>
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
                        <i class="fa-solid fa-book"></i>
                        <button><a class='direccion_invisible' href="/LIBRERIA/estanteria/estanteria.php">Estanteria</a></button>
                        </li>

                </ul>
                <!-- nav del menu principal-->   
            </nav>
        </header>
        <nav id="navegador">

          <ul>
            <li>
                <a href="/LIBRERIA/index.php">Libros</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="">Infantil y juvenil</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="">Novedades</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="">Mas vendidos</a>
            </li>
          </ul>

          <ul>
            <li>
                <a href="">Recomendados</a>
            </li>
          </ul>
          <!-- barra d navegacion-->   
        </nav>
