
<?php 
//value="<?php echp $_SESSION['passwd']"
//<?php echo $_SESSION['username']
if(isset($_SESSION['username'])){
  ?>
    <div id='login'>
      <h2>panel de usuario</h2>
      <input type="text" name="username" disabled value="<?php echo $_SESSION['username'];?>">
      <input type="password" name="passwd"  disabled value = "<?php echo $_SESSION['passwd'];?>">

      <div id="container_extra">
        <div class="extras">
          <button></button>
          <a class='a_login'  href="#">primer boton</a>
        </div>
        <div class="extras">
          <button></button>
          <a class='a_login' href="#">segundo boton</a>
        </div>
      </div>
      <a id="logout_button" href='functions/cerrar_sesion.php'>Cerrar sesión</a>

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


    <div id="container_extra">
      <div class="extras">
        <button></button>
        <a class='a_login' href="validacion.php">Cambiar contraseña</a>
      </div>
      <div class="extras">
        <button></button>
        <a class = 'a_login' href="registrar_usuario.php">Registrarme</a>
      </div>
    </div>


  </div>
  <?php
  }
?>





