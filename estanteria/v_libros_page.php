<?php 
include("../functions/conexion.php");

$id_libro = $_REQUEST['ID_LIBRO'];

global $conn;

$query = $conn->query("SELECT * FROM libro WHERE ID_LIBRO = '$id_libro'");
$result = $query->fetch();

$title = $result['NOM_LIBRO'];

include("../layout/header.php");
?>
<div id="container">
    <div id="contenedor_principal_libros">

  
        <div class="imagen">
            <img src="../<?php echo $result['DIRECCION_IMG'];?>" alt="">
        </div>

        <div id="informacion">
            <div>
                <h2><?php echo $result['NOM_LIBRO'];?></h2>
                <h4>$ <?php echo $result['PRECIO_LIBRO'] ?></h4>
                <div id="result"></div>
            </div>

            <div id="form_add_libro">
                <div>   
                    <label for="cantidad">Cantidad:</label>
                    <select id="cantidad">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <button type="submit" id="add_to_cart" onclick="add_to_cart()" >agregar al estante</button>
            </div>

            <div id="otros">
                <hr>
                <p><b>Genero</b>: <?php echo $result['GENERO_LIBRO']; ?></p>
                <hr>
                <p><b>Autor</b>: <?php echo $result['AUTOR_LIBRO']; ?></p>
                <hr>
                <p><b>Editorial</b>: <?php echo $result['EDITORIAL_LIBRO']; ?></p>
                <hr>
            </div>
        </div>

        


    </div>


    <div id="descripcion">
        <h2>Descripción</h2>
        <P><?php echo $result['DESCRIPCION_LIBRO']; ?></P>
    </div>
    
</div>
<?php include("../layout/footer.php");?>
<?php include("../layout/login.php");?>



    <script>
        localStorage.setItem("id_libro", <?php echo $id_libro ?>);
    </script>

    <script src="script_agregar_al_carrito.js"></script>


