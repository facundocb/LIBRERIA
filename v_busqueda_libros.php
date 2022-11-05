
<?php
    $title = "Resultados de la búsqueda"; //titulo de la pagina
    include("layout/header.php"); //invoca al header
    $nombre_busqueda = strtoupper($_GET['nombre_libro_buscado']); //guarda en la variable 
    //fortalecer acceso sin get
    include("functions/conexion.php"); //incluye la conexión a la base de datos
?>


<div id="container">

<div id="container_titulo">
        <h2>Resultados de buscar:  "<?php echo $nombre_busqueda?>"</h2>  <!-- parsear por html/php -->
</div>




        <div id="filtros_busqueda">
                <form method="post" action="busqueda_libros.php">
                        <label for="filtro_genero" >Genero:</label><input type="text" name="filtro_genero" id="">     
                        <label for="filtro_fecha_desde">Fecha desde</label><input type="date" name="filtro_fecha_desde" id="">
                        <label for="filtro_fecha_hasta" >Hasta</label><input type="date" name="filtro_fecha_hasta" id="">
                        <input type="submit" value="filtrar" name="filtrar" >
                </form>
        </div>
        <div id="contenedor_libros_result">
                <?php 
                        $query_busqueda = $conn->query("SELECT NOM_LIBRO,PRECIO_LIBRO,ID_LIBRO, DIRECCION_IMG FROM libro WHERE NOM_LIBRO  LIKE '%{$nombre_busqueda}%'");
                        $resultado = $query_busqueda->fetchAll();
                        if($resultado){
                                foreach($resultado as $libro){

                ?>
                                        <div class="libros_largos">
                                                <a href="estanteria/v_libros_page.php?ID_LIBRO=<?php echo $libro['ID_LIBRO'];?>">
                                                        <img src="<?php echo $libro['DIRECCION_IMG']; ?>" alt="hola">
                                                </a>
                                                <h4><?php echo $libro['NOM_LIBRO']; ?></h4>
                                                <p>$ <?php echo $libro['PRECIO_LIBRO'];  ?></p>
                                        </div> 
                <?php
                                }    
                        }else{
                                echo 'no hay libros';
                        }
                ?>
        </div>
        
        
        
</div>
        
        
        <?php 
        include("layout/footer.php");
        include("layout/login.php");
        ?>

<script src="/LIBRERIA/layout/script.js"></script>
