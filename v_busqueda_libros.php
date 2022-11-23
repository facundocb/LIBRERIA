
<?php
    $title = "Resultados de la búsqueda"; //titulo de la pagina
    include("layout/header.php"); //invoca al header
    $nombre_busqueda = strtoupper($_REQUEST['nombre_busqueda']); //guarda en la variable 
    //fortalecer acceso sin get
        include("functions/conexion.php"); //incluye la conexión a la base de datos
?>


<div id="container">

<div id="container_titulo">
        <h2>Resultados de buscar:  "<?php echo $nombre_busqueda?>"</h2>  <!-- parsear por html/php -->
</div>




<div id="filtros_busqueda">
	<form method="GET" action='v_busqueda_libros.php'>
		<label for="filtro_genero" >Genero:</label>
		<?php 
		try{

		$db = Conexion::abrir_conexion();

		$query_filtro = $db->query("SELECT DISTINCT GENERO_LIBRO FROM libro ORDER BY GENERO_LIBRO ASC")->fetchAll();    
		echo "<input type='hidden' value='{$nombre_busqueda}' name='nombre_busqueda'>";
		echo "<select  name='filtro_genero'>";
		foreach($query_filtro as $genero){
		echo "<option name='genero' value='{$genero['GENERO_LIBRO']}'>{$genero['GENERO_LIBRO']}</option>";

		}

		}catch(PDOException $e){
		echo "error en la consulta";

		}	
		echo "</select>";

		?>   
		<label for="fecha_desde">Fecha desde</label><input type="date" name="fecha_desde" >
		<label for="fecha_hasta" >Hasta</label><input type="date" name="fecha_hasta">
		<input type="submit" value="filtrar" name="filtrar" >
		</form>
	</div>
	<div id="contenedor_libros_result">
	<?php 


	try{
		$db = Conexion::abrir_mysqli();
		$condicion = '';

		if(isset($_REQUEST['filtro_genero'])){
			$condicion = " AND GENERO_LIBRO = '{$_REQUEST['filtro_genero']}'";
		}
		if(isset($_REQUEST['fecha_desde']) && $_REQUEST['fecha_desde'] != ''){
			$condicion = $condicion . " AND FECHA_PUBLICACION_LIBRO >= {$_REQUEST['fecha_desde']}";
		}
		if( isset($_REQUEST['fecha_hasta']) && $_REQUEST['fecha_hasta'] != ''){
			$condicion = $condicion . " AND FECHA_PUBLICACION_LIBRO <= {$_REQUEST['fecha_hasta']}";
		}


		$nombre_busqueda = $db->real_escape_string($nombre_busqueda);
		$sql = "SELECT NOM_LIBRO,PRECIO_LIBRO,ID_LIBRO, DIRECCION_IMG FROM libro WHERE NOM_LIBRO  LIKE '%{$nombre_busqueda}%' {$condicion} " ;

		$query_busqueda = $db->query($sql);
		//$resultado = $query_busqueda->fetchAll();
		if(mysqli_num_rows($query_busqueda) > 0){
			
			while($libro = $query_busqueda->fetch_array()){
			
				?>
				<h4><?php echo $query_busqueda ; ?></h4>
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
				echo "<p class='error'><span class='material-icons'>warning</span> No hay libros con las condiciones que se solicitaron:(</p>";
			}
	}catch(Exception $e){
	echo "<p class='error'><span class='material-icons'>warning</span> Algo salió mal.</p>";
	die();
	}
	?>
	</div>
			
			
        
</div>
        
        
        <?php 
        include("layout/footer.php");
        include("layout/login.php");
        ?>

<script src="<?php echo $_SESSION['ruta'] ?>/layout/script.js"></script>
