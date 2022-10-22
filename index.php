<?php $title="Página principal";
  session_start();


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
          <h2>NOVEDADES</h2>
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

    <div class="contenedores">
      <!--segunda sección-->
        <div id="container_top">
          <h3 class="subtitulo">¡Para todos los gustos!</h3>
        </div>

      <div class="contenedor_chico">
        <h5>Terror</h5>

          <div class="libros_anchos">
            <img src="RECURSOS/libros/el-descubrimiento-de-las-brujas.jpg" alt="">
            <h5>El resplandor</h5>
          </div>

        <?php 
        
    //     $query_terror = $conn->query("")

        
        ?>




         <a class="ver_mas"href="">Ver más</a>
      </div>

      <div class="contenedor_chico">
        <h5>Infantiles</h5>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/caperucita_roja.jpg" alt="">
          <h5>Caperucita Roja</h5>
        </div>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/los_3_chanchitos.jpg" alt="">
          <h5>Los 3 cerditos</h5>
        </div>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/ricitos_d_oro.jpg" alt="">
          <h5>Ricitos de oro y los 3 osos</h5>
        </div>
        <a class="ver_mas"href="">Ver más</a>

      </div>

      <div class="contenedor_chico">

        <h5>Filosofía</h5>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/el_unico.jpg" alt="">
           <h5>El único y su propiedad</h5>
        </div>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/critica_de_la_razon.jpg" alt="">
          <h5>Critica de la razón</h5>
        </div>

        <div class="libros_anchos">
          <img src="RECURSOS/libros/anchos/zaratustra.jpg" alt="">
          <h5>Así habló Zaratustra</h5>
        </div>
        
        <a class="ver_mas"href="">Ver más</a>
      </div>

      <!-- termina acá-->

    </div>

    <!--tercera sección-->
    <div class="contenedores">
      <div class="caracteristicas">
        <i class="fa-solid fa-store"></i>
        <p>Recogido en librería gratis</p>
      </div>

      <div class="caracteristicas">
        <i class="fa-regular fa-circle-check"></i>
        <p>La compra es 100% segura</p>
      </div>

      <div class="caracteristicas">
        <i class="fa-solid fa-truck-fast"></i>
        <p>Envíos gratis a partir de $1100</p>
      </div>
      <div class="caracteristicas">
        <i class="fa-solid fa-rotate"></i>
        <p>Devoluciones gratis hasta 7 días</p>
      </div>
    <!-- termina acá-->
    </div>

  

</div>

  <?php require("layout/footer.php")?>

  <?php require("layout/login.php")?>


      
 
  


</body>

</html>