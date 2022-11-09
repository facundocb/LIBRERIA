<?php
    $title="Pagina de registro";
    require("layout/header.php");
    require("functions/conexion.php");
?>

<h2 class='titulo'>Bienvenido, ingrese su información personal para registrarse</h2>

<?php

    $NOMBRE = "";
    $APELLIDO = "";
    $LOCALIDAD = "";
    $CI = "";
    $localidad="";
    $USERNAME = "";
    $PASSWORD = "";
    $CONFIRMAR_PASSWORD = "";
    $errors;

    //declara TODAS las variables como vacios

    function detectarError($num, $texto){
        global $errors;
        //si existen errores, entonces se cierra la etiqueda con un color rojo y abajo se pone un p con el valor de errors, declarado mas adelante
        if(isset($errors[$num]))
           echo "style='border-color:#ed4337'><p class='error_p'>{$errors[$num]} </p>";

        else{
             echo "white' value={$texto} >"; 

        }   
    }

    if(isset($_POST['registrarme'])){

        //si existe registrarme (es un boton) entonces...

        $NOMBRE = $_POST['name'];
        $APELLIDO = $_POST['apellido'];
        $LOCALIDAD = $_POST['localidad'];
        $CI = $_POST['CI'];
        $FECHA_NACIMIENTO = $_POST['fecha_nacimiento'];
        $USERNAME = $_POST['username'];
        $PASSWORD = $_POST['password'];
        $CONFIRMAR_PASSWORD = $_POST['confirmar_password'];
        //guardar en local las variables de post


        //VALIDACIONES

        if(strlen($NOMBRE) < 2 || preg_match("/[^[:alpha:]]/",$NOMBRE))
        {
            echo "<script>console.log('". $NOMBRE ."')</script>";
            $errors[0] ='El nombre no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
         //preg_match agarra la variable y la compara con expresiones regulares, si tiene menos d dos caracteres o tiene UNO o MAS que no sean alabeticos tira error
        }    
        if(strlen($APELLIDO) < 2 || preg_match("/[^[:alpha:]]/",$APELLIDO))
        {
            $errors[1]= 'El nombre no puede tener menos de dos caracteres, y no pueden tener caracteres numéricos o especiales';
            //apellido funciona igual que nombre, a mejorar: que se puedan usar espacios        
        }
        if(strlen($LOCALIDAD) < 4 || preg_match("/[^[:word:]\s]/",$LOCALIDAD))
        {
            $errors[2]='La ciudad no puede tener caracteres especiales';
         //esta vez uso word en vez de alpha por si le pinta poner un numero de calle o algo, igual no puede usar espacios asi que a mejorar
        }
      
        if(strlen($CI) < 8 || preg_match("/[^[:digit:]]/",$CI))
        {
            $errors[3]='Ingresá la cedula sin puntos ni guiones(Ej: 1.234.567-8 ingresá 12345678)';
         // digit sirve para los numeros, un alfabetico o simbolo no sirve
        }
        else
        { 
            if(consulta_CI($CI)){
            //funcion de conexion.php
                $errors[3]="La CI ya existe";
            }
        }

        if(strlen($USERNAME) < 4 || preg_match("/\s/", $USERNAME))
        {
            $errors[4]='EL NOMBRE DE USUARIO no puede contener espacios ni ser inferior a 4 carácteres';
         // la barra invertida y la s son para los espacios, en el user mete lo q quieras menos espacios
        }
        else
        {
            //funcion de conexion.php
          if(consulta_usuario($USERNAME)){
            $errors[4]='el user ya está en uso, elegí otro';

          }
        }
        if(strlen($PASSWORD) < 8 || preg_match("/\s/", $PASSWORD))
        {
           $errors[5]='La contraseña no puede tener menos de 8 caracteres , y no puede tener espacios';
 
         //en la password aplica igual que en el user
        }
        if (!$PASSWORD == $CONFIRMAR_PASSWORD){
            $errors[6]='las contraseñas no coinciden';
        }
        //me importa muy poco hacerle una validacion mas que para que sean iguales con la original.
        
        
if(!isset($errors)){
    insertar_cliente($CI, $NOMBRE, $APELLIDO, $LOCALIDAD, $FECHA_NACIMIENTO, $USERNAME, $PASSWORD);
    echo 'usuario ingresado correctamente';
}
else{
    echo 'los datos no se pudieron ingresar';
}

}


?>

<div id="contenedor_login">
  
    
    <form action="" method="post" id="registrar_container"  autocomplete="off"   >

        <input class="input_general" type="text" id="name" name="name" placeholder="Nombre" maxlength="15"
        <?php echo detectarError(0,$NOMBRE);?>
        <input class="input_general" type="text" id="apellido" name="apellido" placeholder="Primer apellido" maxlength="20"
        <?php echo detectarError(1,$APELLIDO);?>
        <input class="input_general" type="text" id="localidad" name="localidad" placeholder="Localidad" maxlength="100"
        <?php echo detectarError(2,$LOCALIDAD);?>
        <input class="input_general" type="text" id="CI" name="CI"  placeholder="cedula de identidad" maxlength="8"
        <?php echo detectarError(3,$CI);?>
        <input class="input_general" type="date" id="fecha_nacimiento" name="fecha_nacimiento"  placeholder="fecha de nacimiento" maxlength="8">

        <input class="input_general" type="text" id="username" name="username" placeholder="nombre de usuario" maxlength="16"
        <?php echo detectarError(4,$USERNAME);?>
        <input class="input_general" type="text" id="password" name="password" placeholder="contraseña" maxlength="16"
        <?php echo detectarError(5,$PASSWORD);?>
        <input class="input_general" type="text" id="confirmar_password" name="confirmar_password" placeholder="confirmar contraseña" maxlength="16"
        <?php echo detectarError(6,$CONFIRMAR_PASSWORD);?>
        <input class="boton_general" type="submit" value="Registrarme" name="registrarme">
    </form>
</div>