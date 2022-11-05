
<?php 
session_start();

$title="Estanteria";
include("../layout/header.php");
include("../functions/conexion.php");

$flag_vacio;
$texto_estante;

if(!isset($_SESSION['username'])){
    $texto_estante = 'carrito vacio';
    $flag_vacio = true; 
}else{
    
    $sql_cantidad = $conn->query("SELECT count(libro.ID_LIBRO) FROM libro INNER JOIN tiene ON tiene.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = tiene.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetch();
    $respuesta = current($sql_cantidad);
    if($respuesta){
        $texto_estante = 'Estanteria /' . $respuesta .  ' libros';
        $flag_vacio = false;
    }
    else{
        $flag_vacio = true; 
        $texto_estante = ' Estanteria / No hay libros agregados';
    }
    
}


?>
<script src="script_estanteria.js"></script>


<div id="panel_estante">
<h2> <?php echo $texto_estante; ?></h2>


<?php 

    if(!$flag_vacio){
        $sql = $conn->query("SELECT libro.ID_LIBRO, libro.NOM_LIBRO, libro.PRECIO_LIBRO, tiene.CANTIDAD FROM libro INNER JOIN tiene ON tiene.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = tiene.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetchAll();
    ?>
    <table id="listado_estante">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>ID</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
            </tr>

        </thead>

        <tbody>
            <?php
            foreach($sql as $row){   
            echo '<tr>';
            echo '<td>' . $row["NOM_LIBRO"] . '</td>';
            echo '<td>' . $row["ID_LIBRO"] . '</td>';
            echo '<td class="cantidad">' . $row["CANTIDAD"] . '</td>';
            echo '<td class="precio">' . $row["PRECIO_LIBRO"] . '</td>';
            echo '</tr>';
            }

    ?>
        </tbody>

        <tfoot>
            <tr id="sub">
            <td align="left" colspan="3">TOTAL:</td>
            <td id="total">$1500</td>
            </tr>
        </tfoot>

    </table>
</div>


<div id="seccion_compra">
    <div class="seccion">
        <h2 class="subtitulo">Informacion personal</h2>
        <input type="text" disabled class="input_texto" id="cedula">
        <input type="text" disabled class="input_texto" id="nombre">
        <input type="text" disabled class="input_texto" id="apellido">
        <input type="text" disabled class="input_texto" id="localidad">
    </div>

    <div class="seccion">
        <h2 class="subtitulo">seleccione un metodo de pago</h2>
            <div id="form_metodo_pago">
                <label for="tarjeta"><input type="radio" name='metodo' id="tarjeta"> Tarjeta de credito Visa, Mastercard u Oca</label>
                <label for="efectivo"><input type="radio" name='metodo' id="efectivo">Pago en efectivo</label>
                <label for="giro"><input type="radio" name='metodo' id="giro">Giro por redpagos</label>
            </div>
    </div>
    <div class="seccion">
        <h2 class='subtitulo'>Notas o solicitudes especiales</h2>
        <input type="text" id="input_texto_largo">
        <button id='comprar' onclick='comprar()'>Confirmar compra</button>
    </div>

    
</div>

    <?php } ?>
  
    <script>
        function calcular_total(){
            let total_div = document.getElementById("total");

            let cantidades = document.getElementsByClassName('cantidad');
            let precios = document.getElementsByClassName('precio');
            let total = 0

            for (i = 0; i < cantidades.length; i++){

            let a = parseInt(cantidades[i].innerHTML);
            let b = parseInt(precios[i].innerHTML)
            
            total+= a * b;
            }
            total_div.innerHTML = "$" + total;
    }
    calcular_total()

    let user = '<?php echo $_SESSION['username'];?>'; 
    localStorage.setItem("user", user);

    
</script>


