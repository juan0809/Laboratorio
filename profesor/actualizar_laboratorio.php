//Actualizar los campos estaticos del laboratorio y tareas (campos dinamicos)
<?php
require_once '../includes/conexion.php';
//se recibe los campos estaticos
$laboratorio = $_POST['laboratorio'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$objetivos = $_POST['objetivos'];
//si no existe imagen se asigna el valor de la imagen anterior
if ($_FILES['imagen']['name'] == '') {
    $imagen = $_POST['imagen_anterior'];
} else {
    //si existe imagen se asigna el valor de la imagen nueva
    $imagen = $_FILES['imagen']['name'];
    //se crea la ruta de la imagen
    $ruta = $_FILES['imagen']['tmp_name'];
    //se crea la carpeta donde se guardara la imagen
    $destino = "images/laboratorios/" . $imagen;
    //se copia la imagen a la carpeta
    move_uploaded_file($ruta, $destino);
}

//se crea la consulta para actualizar los campos estaticos del laboratorio
$sql = "UPDATE laboratorios SET titulo = '$titulo', descripcion = '$descripcion', objetivos = '$objetivos', imagen = '$imagen' WHERE id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();

//se recibe los campos dinamicos de las tareas se recorre el array de input_tarea_id
foreach ($_POST['input_tarea_id'] as $key => $value) {
    //se recibe el id de la tarea
    $tarea_id = $_POST['input_tarea_id'][$key];
    //se recibe el titulo de la tarea
    $titulo_tarea = $_POST['input_array_titulo'][$key];
    //se recibe la descripcion de la tarea si no existe el campo se asigna en blanco
    if (isset($_POST['input_array_descripcion'][$key])) {
        $descripcion_tarea = $_POST['input_array_descripcion'][$key];
    } else {
        $descripcion_tarea = '';
    }
    //si el checkbox de eliminar imagen esta seleccionado se elimina la imagen
    if (isset($_POST['input_array_eliminar_imagen'][$key])) {
        $imagen_tarea = '';
    } else {
        //si no se envia nueva imagen se asigna el valor de la imagen anterior
        if ($_FILES['input_array_imagen']['name'][$key] == '') {
            $imagen_tarea = $_POST['input_array_imagen_anterior'][$key];
        } else {
            //si existe imagen se asigna el valor de la imagen nueva
            $imagen_tarea = $_FILES['input_array_imagen']['name'][$key];
            //se crea la ruta de la imagen
            $ruta = $_FILES['input_array_imagen']['tmp_name'][$key];
            //se crea la carpeta donde se guardara la imagen
            $destino = "images/tareas/" . $imagen_tarea;
            //se copia la imagen a la carpeta
            move_uploaded_file($ruta, $destino);
        }
    }
    
    //se recibe el codigo de la tarea si no existe el campo se asigna en blanco
    if (isset($_POST['input_array_codigo'][$key])) {
        $codigo_tarea = $_POST['input_array_codigo'][$key];
    } else {
        $codigo_tarea = '';
    }
    //se recibe el codigou de la tarea si no existe el campo se asigna en blanco
    if (isset($_POST['input_array_codigou'][$key])) {
        $codigou_tarea = $_POST['input_array_codigou'][$key];
    } else {
        $codigou_tarea = '';
    }
    //se crea la consulta para actualizar los campos dinamicos de la tarea
    $sql = "UPDATE tareas SET titulo_tarea = '$titulo_tarea', descripcion_tarea = '$descripcion_tarea', imagen_tarea = '$imagen_tarea', codigo = '$codigo_tarea', codigou = '$codigou_tarea' WHERE id = $tarea_id";
    $query = $pdo->prepare($sql);
    $query->execute();
}
//se redirecciona a la lista de laboratorios
header("Location: Lista_Laboratorios.php");
?>





