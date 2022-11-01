<?php $title="Página principal";
  session_start();

if(isset($_REQUEST['error'])){
  die();
}


if(isset($_SESSION['logued_as_admin'])){
  session_destroy();
}

 require("layout/header.php");
 //pide el header con el titulo de la pagina principal
 include("functions/conexion.php");
?>

<div id="container">
          <!--aca hay un div que contiene TODO-->
        

          
        <section id="slider">
          <section>
            <div></div>
            <div></div>
            <div></div>
            <div></div>  <!--este es un espejo, emula al primero-->
          </section>
        </section>

        <div id="minih2">
          <h2 class="titulo">NOVEDADES</h2>
        </div>


    <div class="contenedor_libros_largos">

      <!--primera seccion-->


<?php 

  $query_novedades = $conn->query("SELECT DIRECCION_IMG, NOM_LIBRO, PRECIO_LIBRO, ID_LIBRO from libro WHERE STOCK_LIBRO >1 LIMIT 8");
  $result = $query_novedades->fetchALl();
  foreach($result as $libro){
 ?>

<div class="libros_largos">

  <a href="estanteria/libros_page.php?ID_LIBRO=<?php echo $libro['ID_LIBRO'];?>">
          <img src="<?php echo $libro['DIRECCION_IMG']; ?>" alt="hola">
  </a>
  <h4><?php echo $libro['NOM_LIBRO']; ?></h4>
  <p>$ <?php echo $libro['PRECIO_LIBRO'];  ?></p>
                
</div>

<?php
  }
?>
      <!-- aca termina-->  
    </div>
    
      <div class="contenedores">

        <div id="barra_de_busqueda"></div>

        <div class="banner2"></div>

      </div>

    <div class="contenedores" >
      <!--segunda sección-->
        <div id="container_top">
          <h2 class="titulo">¡Para todos los gustos!</h2>
        </div>

      <div class="contenedor_chico">
        <h5>Terror</h5>

      <?php 
        
        $query_terror = $conn->query("SELECT NOM_LIBRO, DIRECCION_IMG FROM libro WHERE GENERO_LIBRO LIKE '%terror%' limit 3")->fetchAll();

        foreach($query_terror as $libro_terror){
      ?>
          <div class="libros_anchos">
            <img src="<?php echo $libro_terror['DIRECCION_IMG'] ?>" alt="">
            <h5><?php echo $libro_terror['NOM_LIBRO'] ?> </h5>
          </div>

        <?php
        }
        ?>

         <a class="ver_mas"href="">Ver más</a>
      </div>


      
      <div class="contenedor_chico">
        <h5>Ensayos</h5>

        <?php 
        
        $query_ensayo = $conn->query("SELECT NOM_LIBRO, DIRECCION_IMG FROM libro WHERE GENERO_LIBRO LIKE '%ensayo%' limit 3")->fetchAll();

        foreach($query_ensayo as $libro_ensayo){
      ?>
          <div class="libros_anchos">
            <img src="<?php echo $libro_ensayo['DIRECCION_IMG'] ?>" alt="">
            <h5><?php echo $libro_ensayo['NOM_LIBRO'] ?> </h5>
          </div>

        <?php
        }
        ?>

        <a class="ver_mas"href="">Ver más</a>

      </div>

      <div class="contenedor_chico">

        <h5>Romance</h5>

        <?php 
        
        $query_romance = $conn->query("SELECT NOM_LIBRO, DIRECCION_IMG FROM libro WHERE GENERO_LIBRO LIKE '%romance%' limit 3")->fetchAll();

        foreach($query_romance as $libro_romance){
      ?>
          <div class="libros_anchos">
            <img src="<?php echo $libro_romance['DIRECCION_IMG'] ?>" alt="">
            <h5><?php echo $libro_romance['NOM_LIBRO'] ?> </h5>
          </div>

        <?php
        }
        ?>
        
        <a class="ver_mas"href="">Ver más</a>
      </div>

      <!-- termina acá-->

    </div>

    <!--tercera sección-->
    <div class="contenedores">
      <div class="caracteristicas">
      <span class="material-icons">store</span>
        <p>Recogido en librería gratis</p>
      </div>

      <div class="caracteristicas">
      <span class="material-icons">verified</span>

      <p>La compra es 100% segura</p>
      </div>

      <div class="caracteristicas">
      <span class="material-icons">local_shipping</span>

        <p>Envíos gratis a partir de $1100</p>
      </div>
      <div class="caracteristicas">
      <span class="material-icons">loop</span>
      
        <p>Devoluciones gratis hasta 7 días</p>
      </div>
    <!-- termina acá-->
    </div>

  

</div>

  <?php require("layout/footer.php")?>

  <?php require("layout/login.php")?>


      
 
  


</body>

</html>