<?php 
include("layout/header.php");

?>

<div id="container">


    <div id="container_cambiar_clave">

        <p>Ingresa la cedula de identidad asociada a tu cuenta sin puntos ni guiones.</p>    
        
        <form method='POST' action='c_verificar_ci.php' id="form_cambiar_clave">
            <input class='input_cambiar_clave' type="text" placeholder='CI'>
            <button class='boton_cambiar_clave'>Enviar</button>
        </form>
    </div>
        

</div>

<script src="layout/script.js">a</script>

<?php
include("layout/footer.php");
include("layout/login.php");

?>