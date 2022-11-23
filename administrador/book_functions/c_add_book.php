
<?php 
    include("../../functions/conexion.php");
    session_start();
   
$user = $_SESSION['username'];
$NOM_LIBRO = $_POST['nom_libro'];
$DESCRIPCION_LIBRO = $_POST['descripcion_libro'];
$PRECIO_LIBRO = $_POST['precio_libro'];
$STOCK_LIBRO = $_POST['stock_libro'];
$AUTOR_LIBRO = $_POST['autor_libro'];
$GENERO_LIBRO = $_POST['genero_libro'];
if($_POST['fecha_publicacion_libro'] != ''){
    $FECHA_PUBLICACION = $_POST['fecha_publicacion_libro'];
}
else{
    $errors[7] = 'fecha no valida';
}
$EDITORIAL_LIBRO = $_POST['editorial_libro'];
$tipos_de_archivo_soportados = ['jpg', 'jpeg', 'png'];
$carpeta_destino = "../../RECURSOS/libros/";

$fecha_subida = date('Y-m-d');
$errors;




if(empty($_FILES['file']['name'])){
    $errors[4] = 'no se han insertado imagenes';
}else{

    $nombre_imagen = basename($_FILES['file']['name']);
    $ruta_destino = $carpeta_destino . $nombre_imagen;
    $tipo_imagen = pathinfo($ruta_destino,PATHINFO_EXTENSION);

    if(!in_array($tipo_imagen, $tipos_de_archivo_soportados)){
        $errors[4] = 'el formato de imagen no es válido';
    }else{
        if(!move_uploaded_file($_FILES['file']['tmp_name'], $ruta_destino))
        $errors[4] = 'no se pudo mover la imagen a la base de datos';
    }

}


if(!verificar_usuario_administrador($user)){
    $errors[10] = 'EL USUARIO NO ES ADMINISTRADOR';
}

if(!preg_match('/^[a-zA-Z0-9\s]{4,70}$/', $NOM_LIBRO )){
    $errors[0] = 'el nombre debe tener entre 4 y 70 caracteres'; 
}

if(!preg_match('/[a-zA-Z0-9\s]/', $DESCRIPCION_LIBRO)){
    $errors[1] = 'la descripcion del libro debe tener entre 30 y 5000 caracteres';
}

if(preg_match('/^\D{0,10000}$/', $PRECIO_LIBRO)){
    $errors[2] = 'el precio del libro no es valido';
}

if(preg_match('/^\D{0,100}$/', $STOCK_LIBRO)){
    $errors[3] = 'el stock del libro tiene que estar entre 0 y 100';
}

if(!preg_match('/^[a-zA-Z\s]{4,50}$/', $GENERO_LIBRO)){
    $errors[6] = 'el genero no puede tener numeros o caracteres especiales.';
}

if(!preg_match('/[a-zA-Z\s]/', $EDITORIAL_LIBRO)){
    $errors[8] = 'la editorial no puede tener numeros o caracteres especiales.';
}

if(!preg_match('/^[a-zA-Z0-9\s]{4,70}$/', $AUTOR_LIBRO )){
    $errors[5] = 'el nombre debe tener entre 4 y 70 caracteres'; 
}


if(isset($errors)){

    $errors['estado'] = 0;
    echo json_encode($errors);
}

else{
    $sql = $conn->prepare('INSERT INTO libro(NOM_LIBRO, PRECIO_LIBRO, DESCRIPCION_LIBRO, STOCK_LIBRO, USERNAME, ESTADO, DIRECCION_IMG, AUTOR_LIBRO, GENERO_LIBRO, EDITORIAL_LIBRO, FECHA_SUBIDA_LIBRO, FECHA_PUBLICACION_LIBRO) VALUES 
    (?,?,?,?,?,?,?,?,?,?,?,?)');

    $insersion_libro = $sql->execute([$NOM_LIBRO, $PRECIO_LIBRO, $DESCRIPCION_LIBRO, $STOCK_LIBRO, $user, '1', $ruta_destino, $AUTOR_LIBRO, $GENERO_LIBRO, $EDITORIAL_LIBRO,$fecha_subida, $FECHA_PUBLICACION ]);

    $result['estado'] = 1;
    echo json_encode($result);

}