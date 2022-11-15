
<?php
include("../functions/conexion.php");
try{

      
        $db = Conexion::abrir_conexion();
        $sql_cantidad = $db->query("SELECT count(libro.ID_LIBRO) FROM libro INNER JOIN tiene ON tiene.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = tiene.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetch();
        $respuesta = current($sql_cantidad);
        if($respuesta){
            $texto_estante = 'Estanteria /' . $respuesta .  ' libros';
            $flag_vacio = false;
        }
        else{
            $flag_vacio = true; 
            $texto_estante = ' Estanteria / No hay libros agregados';
        }
    }catch(PDOException $e){
        echo "error en la consulta";
        die();
    }
    Conexion::cerrar_conexion();
    
?>
    <script src="script_estanteria.js"></script>



<h2> <?php echo $texto_estante; ?></h2>


<?php 
$total = 0;

    if(!$flag_vacio){

        $sql = $db->query("SELECT libro.ID_LIBRO, libro.NOM_LIBRO, libro.PRECIO_LIBRO, tiene.CANTIDAD, tiene.SUBTOTAL FROM libro INNER JOIN tiene ON tiene.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = tiene.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetchAll();
    ?>
        <table id="listado_estante">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>ID</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>

            </thead>

            <?php
            echo '<tbody>';
                foreach($sql as $row){   
                echo '<tr>';
                echo '<td>' . $row["NOM_LIBRO"] . '</td>';
                echo '<td>' . $row["ID_LIBRO"] . '</td>';
                echo '<td class="cantidad">' . $row["CANTIDAD"] . '</td>';
                echo '<td class="precio"> $' . $row["PRECIO_LIBRO"] . '</td>';
                echo '<td class="subtotal"> $' . $row["SUBTOTAL"] . '</td>';
                echo '<td> <button class="boton_general"><span class="material-icons">delete</span></button></td>';
                echo '</tr>';
                $total = $total + $row['SUBTOTAL'];
                }


        ?>
            </tbody>

            <tfoot>
                <tr id="sub">
                <td align="left" colspan="4">TOTAL:</td>
                <td id="total">$<?php echo $total  ?></td>
                <td></td>
                </tr>
            </tfoot>

        </table>
    


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
                    <label for="tarjeta"><input id='tarjeta' type="radio" name='metodo' value="tarjeta"> Tarjeta de credito Visa, Mastercard u Oca</label>
                    <label for="efectivo"><input id='efectivo' type="radio" name='metodo' value="efectivo">Pago en efectivo</label>
                    <label for="giro"><input id='giro' type="radio" name='metodo' value="giro">Giro por redpagos</label>
                </div>
        </div>
        <div class="seccion">
            <h2 class='subtitulo'>Notas o solicitudes especiales</h2>
            <input type="text" id="input_texto_largo">
            <button id='comprar' onclick='comprar()'>Confirmar compra</button>
        </div>
    </div>

    <script>
        let user = '<?php echo $_SESSION['username'];?>'; 
        localStorage.setItem("user", user);
    </script>

    <?php
        }else{
            echo 'hola';
        }
    ?>
  


