<?php 
session_start();

include("../layout/header.php");
include("../functions/conexion.php");
?>
    
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

            if(!isset($_SESSION['logued'])){
                echo 'carrito vacio';
            }
            else{
                $sql = $conn->query("SELECT libro.ID_LIBRO, libro.NOM_LIBRO, libro.PRECIO_LIBRO, tiene.CANTIDAD FROM LIBRO INNER JOIN TIENE ON TIENE.ID_LIBRO = libro.ID_LIBRO INNER JOIN estanteria ON estanteria.ESTADO = 1 AND estanteria.ID_ESTANTERIA = TIENE.ID_ESTANTERIA INNER JOIN usuario_cliente ON usuario_cliente.USERNAME = '{$_SESSION['username']}' AND usuario_cliente.USERNAME = estanteria.USERNAME")->fetchAll();

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

    </script>