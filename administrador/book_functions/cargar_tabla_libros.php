<?php 
     include("../../functions/conexion.php");

    
    $condicion = $_POST['condicion'];

    if(!$condicion == ''){
        $condicion = "WHERE NOM_LIBRO LIKE '%{$condicion}%'";
    }




    $query_libros = $conn->query("SELECT * from libro {$condicion}");
    $resultado = $query_libros->fetchAll();

    echo '<thead>';
        echo '<th>ID</th>';
        echo '<th>NOMBRE</th>';
        echo '<th>StOCK</th>';
        echo '<th>ESTADO</th>';
        echo '<th>AUTOR</th>';
    echo '</thead>'; 

    foreach($resultado as $libro){
        echo "<tr class='result_fila'>";
            echo "<td>" . $libro['ID_LIBRO'] . "</td>";
            echo "<td>" . $libro['NOM_LIBRO'] . "</td>";
            echo "<td>" . $libro['STOCK_LIBRO'] . "</td>";
            echo "<td>" . $libro['ESTADO'] . "</td>";
            echo "<td>" . $libro['AUTOR_LIBRO'] . "</td>";
        echo "</tr>";
    }



?>