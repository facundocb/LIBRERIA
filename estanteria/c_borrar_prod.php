<?php
session_start();
include("../functions/conexion.php");

$id = $_POST['id'];

$estante = consulta_estanteria_activa($_SESSION['username']);


borrar_libro_del_carrito($id,$estante['0']);

?>