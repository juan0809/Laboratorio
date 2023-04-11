<?php

require_once 'includes/header.php';
require_once '../includes/conexion.php';

//se hace la consulta para traer los datos de la tabla laboratorios y tareas
if (!empty($_GET)) {
    $laboratorio = $_GET['laboratorio'];
    $sql = "SELECT * FROM laboratorios WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($laboratorio));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM tareas WHERE laboratorio_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($laboratorio));
    $tareas = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Editar Laboratorio</h1>

            <button class="btn btn-success" type="button" onclick="location.href='Lista_Laboratorios.php'">
                << Volver Atras</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Editar laboratorio</a></li>
        </ul>
    </div>

    <head>
        <!-- Cargar el CSS de Boostrap-->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-highlightjs/css/themes/hemisu-light.css">
    </head>

    <body>
        <main role="main" class="container my-auto">
            <div class="row">
                <div class="col-10">
<?php
// Se crea el formulario para editar los campos estaticos del laboratorio y tareas (campos dinamicos)
 echo  '<form action="actualizar_laboratorio.php" method="POST" enctype="multipart/form-data">' ;
    echo  '<div class="form-group">' ;
        echo  '<label for="titulo">Titulo</label>' ;
        echo  '<input type="text" class="form-control" id="titulo" name="titulo" value="' .$result['titulo']. '">' ;
    echo  '</div>' ;
    echo  '<div class="form-group">' ;
        echo  '<label for="descripcion">Descripcion</label>' ;
        echo  '<textarea class="form-control" id="descripcion" name="descripcion" rows="3">' .$result['descripcion']. '</textarea>' ;
    echo  '</div>' ;
    echo  '<div class="form-group">' ;
        echo  '<label for="objetivos">Objetivos</label>' ;
        echo  '<textarea class="form-control" id="objetivos" name="objetivos" rows="3">' .$result['objetivos']. '</textarea>' ;
    echo  '</div>' ;
    echo  '<div class="form-group">' ;
        //mostrar imagen
        echo  '<label for="imagen">Imagen</label>' ;
        echo  '<img src="images/laboratorios/' .$result['imagen']. '" width="100" height="100" class="img-thumbnail" />' ;
        echo  '<input type="file" class="form-control-file" id="imagen" name="imagen">' ;
        //campo oculto para enviar el id del laboratorio
        echo  '<input type="hidden" id="laboratorio" name="laboratorio" value="' .$laboratorio. '">' ;
        //campo oculto para enviar el nombre de la imagen
        echo  '<input type="hidden" id="imagen_anterior" name="imagen_anterior" value="' .$result['imagen']. '">' ;
    echo  '</div>' ;
    
    // se crean los campos dinamicos de las tareas (solo campos con datos)
    foreach ($tareas as $tarea) {
        //si el campo titulo tiene datos se crea el campo
        if ($tarea['titulo_tarea'] != '') {
            echo  '<div class="form-group">' ;
                echo  '<strong><label for="input_array_titulo">Tarea - '.$tarea['titulo_tarea'].'</label></strong>' ;
                echo  '<div class="input-group">' ;
                echo  '<input type="text" class="form-control" id="input_array_titulo" name="input_array_titulo[]" value="' .$tarea['titulo_tarea']. '">' ;
                echo  '</div>' ;
            echo  '</div>' ;
        }
        //si el campo descripcion tiene datos se crea el campo
        if ($tarea['descripcion_tarea'] != '') {
            echo  '<div class="form-group">' ;
                echo '<label for="input_array_descripcion">Descripcion</label>' ;
                echo  '<textarea class="form-control" id="input_array_descripcion" name="input_array_descripcion[]" rows="3">' .$tarea['descripcion_tarea']. '</textarea>' ;
            echo  '</div>' ;
        }
        //si el campo imagen tiene datos se crea el campo
        if ($tarea['imagen_tarea'] != '') {
            echo  '<div class="form-group">' ;
                //mostrar imagen
                echo  '<label for="input_array_imagen">Imagen</label>' ;
                echo  '<img src="images/tareas/' .$tarea['imagen_tarea']. '" width="100" height="100" class="img-thumbnail" />' ;
                //checkbox para eliminar la imagen
                echo '<div class="form-check">' ;
                    echo '<input class="form-check-input" type="checkbox" value="1" id="input_array_eliminar_imagen" name="input_array_eliminar_imagen[]">' ;
                    echo '<label class="form-check-label" for="input_array_eliminar_imagen">Eliminar Imagen</label>' ;
                echo '</div>' ;
                echo  '<input type="file" class="form-control-file" id="input_array_imagen" name="input_array_imagen[]">' ;
                //campo oculto para enviar el nombre de la imagen
                echo  '<input type="hidden" id="input_array_imagen_anterior" name="input_array_imagen_anterior[]" value="' .$tarea['imagen_tarea']. '">' ;
            echo  '</div>' ;
        }
        //si el campo codigo tiene datos se crea el campo
        if ($tarea['codigo'] != '') {
            echo  '<div class="form-group">' ;
                echo '<label for="input_array_codigo">Codigo</label>' ;
                echo  '<textarea class="form-control" id="input_array_codigo" name="input_array_codigo[]" rows="3">' .$tarea['codigo']. '</textarea>' ;
            echo  '</div>' ;
        }
        //si el campo codigoU tiene datos se crea el campo
        if ($tarea['codigou'] != '') {
            echo  '<div class="form-group">' ;
                echo '<label for="input_array_codigou">CodigoU</label>' ;
                echo  '<textarea class="form-control" id="input_array_codigou" name="input_array_codigou[]" rows="3">' .$tarea['codigou']. '</textarea>' ;
            echo  '</div>' ;
        }
        //campo oculto para enviar el id de la tarea
        echo  '<input type="hidden" id="input_tarea_id" name="input_tarea_id[]" value="' .$tarea['id']. '">' ;
    }

    echo  '<button type="submit" class="btn btn-primary">Actualizar</button>' ;
    echo  '</form>' ;
?>
                </div>
            </div>
        </main>
    </body>

<?php
    require_once 'includes/footer.php';
?>