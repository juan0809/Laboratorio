<?php
require_once '../includes/conexion.php';

    $validar = true;
    //campos estaticos
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $objetivos = $_POST['objetivos'];

    //variables del archivo imagen
    $file = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];
    $temp = $_FILES['imagen']['tmp_name'];
    $destino = "./images/laboratorios/$file";

    //validar que todos los campos esten llenos
    if ($titulo == '' || $descripcion == '' || $objetivos == '' || $file == '') {
        echo "Por favor llene todos los campos";
        $validar = false;
        exit();
    }

    //validar  que el archivo sea de tipo imagen
    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
        echo "El archivo no es una imagen";
        $validar = false;
        exit();
    }
    //validar que el archivo no sea mayor a 10MB
    if ($tamano > 10000000) {
        echo "El archivo es demasiado grande";
        $validar = false;
        exit();
    }

    //validar los campos dinamicos antes de guardarlos en la base de datos
    if (isset($_POST['input_array_titulo'])) {
        $count = count($_POST['input_array_titulo']);
        for ($i = 0; $i < $count; $i++) {
            if (isset($_FILES['input_array_imagen']['name'][$i])) {
                //guardar archivo en la carpeta de images/tareas
                $tipo = $_FILES['input_array_imagen']['type'][$i];
                $tamano = $_FILES['input_array_imagen']['size'][$i];
                //validar  que el archivo sea de tipo imagen
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
                    echo "El archivo no es una imagen";
                    $validar = false;
                    exit();
                }
                //validar que el archivo no sea mayor a 10MB
                if ($tamano > 10000000) {
                    echo "El archivo es demasiado grande";
                    $validar = false;
                    exit();
                }
            }
        }
    }

    //Si no hay errores se guardan los datos en la base de datos
    if ($validar) {
        //Se guarda el archivo de imagen en la carpeta images/laboratorios
        move_uploaded_file($temp, $destino);

        //Se guarda en la base de datos los campos estaticos
        $sql = "INSERT INTO laboratorios (titulo, imagen, descripcion, objetivos) VALUES ('$titulo', '$file', '$descripcion', '$objetivos')";
        $query = $pdo->prepare(($sql));
        $query->execute();
        $id_laboratorio = $pdo->lastInsertId();

        //Si existen los campos dinamicos se guardan en la base de datos
        if (isset($_POST['input_array_titulo'])) {
            $count = count($_POST['input_array_titulo']);
            for ($i = 0; $i < $count; $i++) {
                $titulo = $_POST['input_array_titulo'][$i];
                if (isset($_POST['input_array_descripcion'][$i])) {
                    $descripcion = $_POST['input_array_descripcion'][$i];
                } else {
                    $descripcion = '';
                }
                if (isset($_FILES['input_array_imagen']['name'][$i])) {
                    $imagen = $_FILES['input_array_imagen']['name'][$i];
                    //guardar archivo en la carpeta de images/tareas
                    $temp = $_FILES['input_array_imagen']['tmp_name'][$i];
                    $destino = "./images/tareas/$imagen";
                    // guardar la imagen en la carpeta de images/tareas
                    move_uploaded_file($temp, $destino);
                } else {
                    $imagen = '';
                }
                if (isset($_POST['input_array_codigo'][$i])) {
                    $codigo = $_POST['input_array_codigo'][$i];
                } else {
                    $codigo = '';
                }
                if (isset($_POST['input_array_codigou'][$i])) {
                    $codigou = $_POST['input_array_codigou'][$i];
                } else {
                    $codigou = '';
                }
                $sql = "INSERT INTO tareas (titulo_tarea, descripcion_tarea, imagen_tarea, codigo, codigou, laboratorio_id) VALUES ('$titulo', '$descripcion', '$imagen', '$codigo', '$codigou', '$id_laboratorio')";
                $query = $pdo->prepare(($sql));
                $query->execute();
            }
        }
    }
    // se envia mensaje de exito
    echo "success";
    //Se cierra la conexion
    $pdo = null;
?>