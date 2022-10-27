
<?php 
//value="<?php echp $_SESSION['passwd']"
//<?php echo $_SESSION['username']
if(isset($_SESSION['username'])){
  ?>
    <div id='login'>
    <h2>panel d usuario</h2>
    <input type="text" name="username" disabled value="<?php echo $_SESSION['username'];?>">
    <input type="password" name="passwd"  disabled value = "<?php echo $_SESSION['passwd'];?>">

    <div id="container_extra">
      <div class="extras">
        <button></button>
        <p>primer boton</p>
        </div>
        <div class="extras">
          <button></button>
          <p>segundo boton</p>
        </div>
        </div>
        <a id="logout_button" href='functions/cerrar_sesion.php'>Cerrar sesión</a>
      </div>

  <?php
  }   
  else{
    ?>

    <div id="login">
    <p id="abridor_menu" onclick="abrir_menu()">&#9776;</p>
      
    <form id="formulario" action="ingresar_usuario.php" autocomplete="off" method="POST">
      <input type="text" placeholder="User" name="username">
      <input type="password" placeholder="Password" name="passwd">
      <input id="boton" type="submit" name="ingresar" value="Login">
    </form>


    <div>
      <p>¿Olvidaste tu contraseña?</p>
      <a href="modificar_usuario.php">Cambiar contraseña</a>
      <p>¿No tenés una cuenta?</p>
      <a href="registrar_usuario.php">Crear cuenta</a>
    </div>


  </div>
  <?php
  }
?>





