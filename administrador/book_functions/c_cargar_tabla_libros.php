<?php 
     include("../../functions/conexion.php");

    
    $condicion = $_POST['condicion'];

    if(!$condicion == ''){
        $condicion = "WHERE NOM_LIBRO LIKE '%{$condicion}%'";
    }



    try{
        $db = Conexion::abrir_conexion();
        
        $query_libros = $db->query("SELECT * from libro {$condicion}");
        $resultado = $query_libros->fetchAll();
        echo ' <table id="result_consulta_libros">';
        echo '<thead>';
            echo '<th>ID</th>';
            echo '<th>NOMBRE</th>';
            echo '<th>STOCK</th>';
            echo '<th>AUTOR</th>';
            echo '<th>ESTADO</th>';
        echo '</thead>'; 
    
        foreach($resultado as $libro){

            

            if($libro['STOCK_LIBRO'] <= 0){
                echo "<tr class='result_fila_error'>";
                    echo "<td class='celda_error'>" . $libro['ID_LIBRO'] . "</td>";
                    echo "<td class='celda_error'>" . $libro['NOM_LIBRO'] . "</td>";
                    echo "<td class='celda_error'>" . $libro['STOCK_LIBRO'] . "</td>";
                    echo "<td class='celda_error'>" . $libro['AUTOR_LIBRO'] . "</td>";
                    echo "<td class='celda_error'>" . $libro['ESTADO'] . "</td>";
                echo "</tr>";
            }else{

                echo "<tr class='result_fila'>";
                    echo "<td>" . $libro['ID_LIBRO'] . "</td>";
                    echo "<td>" . $libro['NOM_LIBRO'] . "</td>";
                    echo "<td>" . $libro['STOCK_LIBRO'] . "</td>";
                    echo "<td>" . $libro['AUTOR_LIBRO'] . "</td>";
                    echo "<td>" . $libro['ESTADO'] . "</td>";
                echo "</tr>";
            }
        }

        echo '</table>';

    }catch(PDOException $e){
        echo 'hubo un error al conectarse a la bd';
    }



?>

