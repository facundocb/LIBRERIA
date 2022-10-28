
<?php 
session_start();


include("../layout/header.php");
include("../functions/conexion.php");
?>

    <script src="script_estanteria.js"></script>


    <div id="panel_estante">
          <h2>Estanteria / 2 libros</h2>

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

            if(!isset($_SESSION['username'])){
                echo 'carrito vacio';
                
            }
            else{
                $sql = $conn->query("SELECT libro.ID_LIBRO, libro.NOM_LIBRO, libro.PRECIO_LIBRO, tiene.CANTIDAD FROM libro INNER JOIN tiene ON tiene.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = tiene.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetchAll();

                foreach($sql as $row){
                    
                    echo '<tr>';
                        echo '<td>' . $row["NOM_LIBRO"] . '</td>';
                        echo '<td>' . $row["ID_LIBRO"] . '</td>';
                        echo '<td class="cantidad">' . $row["CANTIDAD"] . '</td>';
                        echo '<td class="precio">' . $row["PRECIO_LIBRO"] . '</td>';
                    echo '</tr>';
                }
            
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
        <input type="text" disabled class="input_texto" id="cedula">
        <input type="text" disabled class="input_texto" id="nombre">
        <input type="text" disabled class="input_texto" id="apellido">
        <input type="text" disabled class="input_texto" id="localidad">
    </div>

    <div class="seccion">
        <h2 class="subtitulo">seleccione un metodo de pago</h2>

        
            <input type="radio" id="tarjeta"> <label for="tarjeta">Tarjeta de credito Visa, Mastercard u Oca</label>
            <input type="radio" id="efectivo"> <label for="efectivo">Pago en efectivo</label>
            <input type="radio" id="giro"> <label for="giro">Giro por redpagos</label>

          

    </div>
    <div class="seccion">
        <h2>Notas o solicitudes especiales</h2>
        <input type="text" class="input_texto_largo">
        <button id='comprar'>Confirmar compra</button>
    </div>

    
</div>




<?php if(isset($_SESSION['username'])){

 ?>
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



<?php 
    }
?>
