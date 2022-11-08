<?php 
include("layout/header.php");

?>

<div id="container">


    <div id="container_cambiar_clave">

        <p>Ingresa la cedula de identidad asociada a tu cuenta sin puntos ni guiones.</p>    
        
        <form method='POST' action='c_verificar_ci.php' id="form_cambiar_clave">
            <input class='input_general' name='ci' type="text" placeholder='CI'>
            <button class='boton_general'>Enviar</button>
        </form>



        <div id="RESULT">
            <?php
                if(isset($_REQUEST['error'])){
                     echo "<div class='error'> <span class='material-icons'>report_problem</span> <p class='error_texto'>la ci no existe en la base de datos</p></div>"; 
                }
            ?>    
        </div>

    </div>



</div>

<script src="layout/script.js">a</script>

<?php
include("layout/footer.php");
include("layout/login.php");

?>