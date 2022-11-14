<?php
include("../../functions/conexion.php");

$contador = 0;
$db = Conexion::abrir_conexion();
        
$query_libros = $db->query("SELECT STOCK_LIBRO from libro");
$resultado = $query_libros->fetchAll();

foreach($resultado as $cantidad){
    if($cantidad['STOCK_LIBRO'] <= 0){
        $contador = $contador + 1;
    }
}

if($contador > 1){
    echo "<div class='alerta_stock'><span class='material-icons'>warning</span>Hay {$contador} libros sin stock</div>";
}

?>