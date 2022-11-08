<?php
include("layout/header.php");
?>


<div id="container">

    <div id="container_cambiar_clave">

        
        <form id='form_actualizar_clave' action="c_actualizar_clave.php" method='POST'>
            <label class='label_general' for="password">Ingresá la clave</label> <input type="text" name='password' class="input_general">
            <label class='label_general' for="confirm_password">Volvé a ingresar la clave</label> <input type="text" name='confirm_password'class="input_general">
            <button class="boton_general">Cambiar clave</button>
        </form>
        
        <div id="RESULT">
            <?php
                if(isset($_REQUEST['error'])){
                    if($_REQUEST['error'] = 1){
                        echo "<div class='error'> <span class='material-icons'>report_problem</span> <p class='error_texto'>las contraseñas no coinciden</p></div>"; 
                    }
                    else{
                        echo "<div class='error'> <span class='material-icons'>report_problem</span> <p class='error_texto'>las contraseñas es muy corta</p></div>"; 

                    }
                }

                if(isset($_REQUEST['success'])){
                    echo "<div class='ok'> <span class='material-icons'>done</span> <p class='ok_texto'> Se actualizo la contraseña</p></div>";
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