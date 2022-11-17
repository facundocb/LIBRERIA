<?php
    $title="Pagina de registro";
    require("layout/header.php");
?>

<h2 class='titulo'>Bienvenido, ingrese su información personal para registrarse</h2>

<div id="contenedor_login">
  
    <div id="result_register"></div>

    <div id="registrar_container"  autocomplete="off"   >

        <input class="input_general" type="text" id="name" name="name" placeholder="Nombre" maxlength="15">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="apellido" name="apellido" placeholder="Primer apellido" maxlength="20">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="localidad" name="localidad" placeholder="Localidad" maxlength="100">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="CI" name="CI"  placeholder="cedula de identidad" maxlength="8">
        <div class='error_container'></div>
        <input class="input_general" type="date" id="fecha_nacimiento" name="fecha_nacimiento"  placeholder="fecha de nacimiento" maxlength="8">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="username" name="username" placeholder="nombre de usuario" maxlength="16">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="password" name="password" placeholder="contraseña" maxlength="16">
        <div class='error_container'></div>
        <input class="input_general" type="text" id="confirmar_password" name="confirmar_password" placeholder="confirmar contraseña" maxlength="16">
        <div class='error_container'></div>
        <button class="boton_general" id="registrar_boton" onclick="registrar_usuario()">Registrarme<button>
    </div>
</div>


<script src='registrar_usuario.js'></script>