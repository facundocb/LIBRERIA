
<?php 
//value="<?php echp $_SESSION['passwd']"
//<?php echo $_SESSION['username']
if(isset($_SESSION['username'])){
  ?>
    <div id='login'>
      <h2>panel de usuario</h2>
      <input class="login_input" type="text" name="username" disabled value="<?php echo $_SESSION['username'];?>">
      <input class="login_input" type="password" name="passwd"  disabled value = "<?php echo $_SESSION['passwd'];?>">

      <div id="container_extra" onmouseenter='mostrar_opciones_login()'>
        <div class="extras">
          <span class="material-icons">person</span>
          <a href="<?php echo $_SESSION['ruta'] ;  ?>/v_info_de_perfil.php"> <p class='texto_login'>Mi perfil</p></a>
        </div>
        <div class="extras">
          <span class="material-icons">history</span>
          <a  href="<?php echo $_SESSION['ruta'] ;  ?>/v_historial_de_compras.php"> <p class='texto_login'> Historial de compras</p></a>
        </div>
      </div>
      <a id='salir' href='<?php echo $_SESSION['ruta'] ;  ?>/functions/c_cerrar_sesion.php'> <button class="boton_general">Cerrar sesión</button></a>

  <?php
  }   
  else{
    ?>

    <div id="login">
    <p id="abridor_menu">&#9776;</p>
      
    <form id="formulario" action="<?php echo $_SESSION['ruta'] ;  ?>/c_ingresar_usuario.php" autocomplete="off" method="POST">
      <input class='login_input'  type="text" placeholder="User" name="username">
      <input class='login_input'  type="password" placeholder="Password" name="passwd">
      <input class="boton" type="submit" name="ingresar" value="Login">
    </form>


    <div id="container_extra" onmouseenter='mostrar_opciones_login()'>
      <div class="extras">
        <span class="material-icons">lock_reset</span>  
        <a href="v_cambiar_clave.php"><p class='texto_login'>Cambiar contraseña</p></aclass=>
      </div>

      <div class="extras">
        <span class="material-icons">how_to_reg</span>  
        <a href="v_registrar_usuario.php"><p class='texto_login'>Registrarse</p></a>
      </div>
    </div>


  </div>
  <?php
  }
?>





