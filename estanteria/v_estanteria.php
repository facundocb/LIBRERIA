
<?php 
session_start();

$title="Estanteria";
include("../layout/header.php");

$flag_vacio;
$texto_estante;

if(!isset($_SESSION['username'])){
    $texto_estante = 'carrito vacio';
    $flag_vacio = true; 
}else{
    include("c_cargar_estante.php");
}

?>


