<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal_laboratorio.php';
$idprofesor = $_SESSION['profesor_id'];
if (!empty($_GET['curso'])) {
    $curso = $_GET['curso'];
  } else {
    $sql = "SELECT * FROM profesor_materia as pm 
    INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
    INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm !=0 AND pm.profesor_id =
    $idprofesor";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
    }
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Nuevo Laboratorio</h1>

            <button class="btn btn-success" type="button" onclick="location.href='Lista_Laboratorios.php'">
                << Volver Atras</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de laboratorios</a></li>
        </ul>
    </div>

    <head>
        <!-- Cargar el CSS de Boostrap-->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-highlightjs/css/themes/hemisu-light.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.css" />
        <!-- Include the CodeMirror JavaScript files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/clike/clike.min.js"></script>
    </head>

    <body>
        <main role="main" class="container my-auto">
            <div class="row">
                <div class="col-10">
                    <form id="FormData" method="POST" enctype="multipart/form-data" class="wrapper">
                        <div class="form-group col-6">
                            <b> <label for="titulo">Título :</label></b>
                            <input id="titulo" name="titulo" class="form-control" type="text" placeholder="Título">
                        </div>
                        <?php if (!empty($_GET['curso'])) {
                                ?>
                            <input type="hidden" name="materias" id="materias" value="<?php echo $_GET['curso']; ?>">

                        <?php 
                        } ?>
                        <?php if ($row > 0) {
                            while ($data = $query->fetch()) {
                                ?>
                                <div class="form-group col-12">
                                <b><label for="materias">Escoja una materia:</label></b>
                                    <select class="form-control" id="materias" name="materias">
                                        <option value=""></option>
                                        <option value="<?= $data['materia_id']; ?>"><?= $data['nombre_materia']; ?></option>
                                    </select>
                                </div>
                            <?php }
                        } ?>
                        <div class="form-group col-6">
                            <b> <label for="imagen">Imagen :</label></b>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                        </div>

                        <div class="form-group col-12">

                            <b> <label for="descripcion">Descripcion:</label></b>
                            <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <b> <label for="objetivos">Objetivos:</label></b>
                            <textarea name="objetivos" class="form-control" id="objetivos" rows="4"></textarea>
                        </div>

                    </form>
                </div>
            </div>
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            // Change all editors to java mode

            //Add Input Fields
            $(document).ready(function () {
                var max_fields = 16; //Maximum allowed input fields 
                var wrapper = $(".wrapper"); //Input fields wrapper
                var x = 1; //Initial input field is set to 1
                document.addEventListener('DOMContentLoaded', () => {
                    hljs.highlightBlock(codigoJS);
                    const codigoJS = document.querySelector('.codigo');
                });

                //When user click on add input button
                $("#btn_titulo").click(function (e) {
                    if (x < max_fields) {
                        x++; //input field increment
                        $(wrapper).append('<div class="form-group col-6"><b><label for="titulo">Título Tarea:</label></b><br/><input class="form-control" type="text" name="input_array_titulo[]" cols="40" placeholder="Agregue Título" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
                    }
                });

                $("#btn_descripcion").click(function (e) {
                    if (x < max_fields) {
                        x++; //input field increment
                        $(wrapper).append('<div class="form-group col-12"><b> <label for="descripcion">Descripción :</label></b><br/><textarea class="form-control" name="input_array_descripcion[]" rows="4" cols="78" placeholder="Agregue la descripción" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
                    }
                });

                $("#btn_codigo").click(function (e) {
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(wrapper).append('<div class="form-group col-12"><b><label for="codigo">Codigo :</label></b><br/><textarea spellcheck="false" oninput="update(this.value); sync_scroll(this);" onscroll="sync_scroll(this);" onkeydown="check_tab(this, event);" class="codigo form-control" name="input_array_codigo[]" rows="4" cols="78" placeholder="Agregue el código" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
                        var textareas = document.getElementsByName("input_array_codigo[]");
                        for (var i = textareas.length - 1; i < textareas.length; i++) {
                            var textarea = textareas[i];
                            var editor = CodeMirror.fromTextArea(textarea, {
                                mode: "text/x-java",
                                lineNumbers: true
                            });
                        }
                    }
                });

                $("#btn_codigou").click(function (e) {
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(wrapper).append('<div class="form-group col-12"><b><label for="codigou">Codigo Unitario :</label></b><br/><textarea class="form-control" name="input_array_codigou[]" rows="4" cols="78" placeholder="Agregue el código U" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
                        var textareas = document.getElementsByName("input_array_codigou[]");
                        for (var i = textareas.length - 1; i < textareas.length; i++) {
                            var textarea = textareas[i];
                            var editor = CodeMirror.fromTextArea(textarea, {
                                mode: "text/x-java",
                                lineNumbers: true
                            });
                        }
                    }
                });

                $("#btn_imagen").click(function (e) {
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(wrapper).append('<div class="form-group col-6"><b> <label for="imagen">Imagen :</label></b><input type="file" class="form-control" name="input_array_imagen[]"><a href="javascript:void(0);" class="remove_field">Remove</a></div>');
                    }
                });

                //when user click on remove button
                $(wrapper).on("click", ".remove_field", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //remove inout field
                    x--; //inout field decrement
                })
                //when click on save button
                $('#guardar').click(function (e) {
                    e.preventDefault();
                    var titulo = $('#titulo').val();
                    var descripcion = $('#descripcion').val();
                    var objetivos = $('#objetivos').val();
                    var materiaId = $('#materia-opciones').val();
                    //se envia el archivo de imagen
                    var imagen = $('#imagen').val();
                    var input_array_titulo = [];
                    var input_array_descripcion = [];
                    var input_array_codigo = [];
                    var input_array_codigou = [];
                    var input_array_imagen = [];
                    $('input[name="input_array_titulo[]"]').each(function () {
                        input_array_titulo.push($(this).val());
                    });
                    $('textarea[name="input_array_descripcion[]"]').each(function () {
                        input_array_descripcion.push($(this).val());
                    });
                    $('textarea[name="input_array_codigo[]"]').each(function () {
                        input_array_codigo.push($(this).val());
                    });
                    $('textarea[name="input_array_codigou[]"]').each(function () {
                        var self = $(this);
                        let codeMirrors = $(".CodeMirror");
                        codeMirrors.each(function (index, codeMirror) {
                            let cm = codeMirror.CodeMirror;
                            cm.save()
                            input_array_codigou.push(cm.getValue());
                        });
                    });
                    $('input[name="input_array_imagen[]"]').each(function () {

                        input_array_imagen.push($(this).val());
                    });

                    //Verificar que los campos no esten vacios
                    if (titulo == '' || descripcion == '' || objetivos == '' || imagen == '' || materiaId == '') {
                        alert("Por favor llene todos los campos");
                    } else {
                        //Guardar los datos en la base de datos
                        const formData = new FormData(document.getElementById("FormData"));
                        $.ajax({
                            url: "guardar_laboratorio.php",
                            type: "POST",
                            dataType: "html",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                if (data == "success") {
                                    //alert("Datos guardados correctamente");
                                    window.location.href = "lista_laboratorios.php";
                                } else {
                                    alert(data);
                                }
                            }

                        });
                    }
                });
            });
        </script>
        <br />
        <h4>Agregar tareas :</h4>
        <br />
        <button id="btn_titulo" class="btn btn-success ">Agregar Titulo</button>
        <button id="btn_descripcion" class="btn btn-info ">Agregar Descripcion</button>
        <button id="btn_codigo" class="btn btn-warning ">Agregar codigo</button>
        <button id="btn_codigou" class="btn btn-success ">Agregar Codigo U</button>
        <button id="btn_imagen" class="btn btn-info ">Agregar Imagen</button>
        <button id="guardar" class="btn btn-danger icon-btn" type="submit">Guardar</button>
    </body>
</main>

<?php
require_once 'includes/footer.php';
?>