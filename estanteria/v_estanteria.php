
<?php 
session_start();

$title="Estanteria";
include("../layout/header.php");

$flag_vacio;
$texto_estante;
?>
<div id="container">
    <div id="panel_estante">
        <?php
        if(!isset($_SESSION['username'])){
                $texto_estante = 'carrito vacio';
                
                echo "<h4 class='subtitulo'>No iniciaste sesion!</h4>";
                }else{
                
                    include("c_cargar_estante.php");
                }
                ?>
    </div>


</div>
<script src="../layout/script.js"></script>
<?php

include("../layout/footer.php");
include("../layout/login.php");
?>


