<?php 
    include("conexion.php");
    session_start();
    $user = $_SESSION['username'];

    $compras = cargar_historial_de_compras($user); //funcion de la bd

    if($compras){
        echo '<h2 class="subtitulo">Historial</h2>';
        echo '<table id="tabla_historial">';
            echo '<thead>';
                echo '<th>Libro</th>';
                echo '<th>Cantidad</th>';
                echo '<th >Subtotal</th>';
                echo '<th>Fecha</th>';
                echo '<th>Metodo de pago</th>';
            echo '</thead>'; 
   
       foreach($compras as $comp){
            echo "<tr class='result_fila'>";
               echo "<td>" . $comp['NOM_LIBRO'] . "</td>";
               echo "<td>" . $comp['CANTIDAD'] . "</td>";
               echo "<td>" . $comp['SUBTOTAL'] . "</td>";
               echo "<td>" . $comp['FECHA'] . "</td>";
               echo "<td>" . $comp['METODO_DE_PAGO'] . "</td>";
            echo "</tr>";
       }
       echo '</table>'; 
    }else{
        echo '<h2 class="titulo">Historial de compras</h2>';
        echo '<p>No tienes ninguna compra realizada!</p>';
    }



?>