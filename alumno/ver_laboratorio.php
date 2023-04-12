<?php
if (!empty($_GET['laboratorio'])) {
  $laboratorio = $_GET['laboratorio'];
} else {
  header("Location: profesor");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

//consulta del laboratorio
$sql = "SELECT * FROM laboratorios WHERE id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetch();

//consulta de las tareas
$sql = "SELECT * FROM tareas WHERE laboratorio_id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
$tareas = $query->fetchAll();

?>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/editor.css">
<!-- Cargar el CSS de Boostrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-highlightjs/css/themes/hemisu-light.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.css" />
<!-- Include the CodeMirror JavaScript files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.0/mode/clike/clike.min.js"></script>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Laboratorio <?= $data['titulo']; ?></h1>
      <a href="Lista_Laboratorios.php" class="btn btn-info">
      << Volver Atras</a>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Laboratorios</a></li>
    </ul>
  </div>
  <div>
  <img src="../profesor/images/laboratorios/<?=$data['imagen'] ?>" width="45%" alt="<?= $data['titulo']; ?>">
  </div>
  <br/>
  <div>
    <p><?= $data['descripcion']; ?> </p>
  </div>
  <div>
    <p class="font-weight-bold">Objetivos:</p>
    <P><?= $data['objetivos']; ?></P>
  </div>

  <!-- Lista de tareas -->
    <div>
    <?php foreach ($tareas as $tarea) { ?>
        <?php if (!empty($tarea['titulo_tarea'])) { ?>
            <h5><?= $tarea['titulo_tarea']; ?></h5>
        <?php } ?>
        <br/>
        <?php if (!empty($tarea['imagen_tarea'])) { ?>
          <img src="../profesor/images/tareas/<?=$tarea['imagen_tarea'] ?>" width="45%" style="margin: 0 auto;" <?= $tarea['titulo_tarea']; ?>">
        <?php } ?>
        <?php if (!empty($tarea['descripcion_tarea'])) { ?>
            <p><?= $tarea['descripcion_tarea']; ?></p>
        <?php } ?>
        <?php if (!empty($tarea['codigo'])) { ?>
          <strong> <p>Código:</p></strong>
            <textarea name="code_codigo" id="" cols="80" rows="10"><?= $tarea['codigo']; ?></textarea>
            <a href="Lista_Laboratorios.php" class="btn btn-info">
          Probar</a>
        <?php } ?>
        <?php if (!empty($tarea['codigou'])) { ?>
        <p>Código U:</p>
        <div class="editor-div">
            <button class="run" id="run">Run</button>
          <textarea id="editor"> <?= $tarea['codigou']; ?> </textarea>
        </div>
        <h3 class="output-header">Output</h3>
        <p class="code_output" id="code_output"></p>
        <ul id="string-list"></ul>
         <script>
          editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            mode: "text/x-java",
            lineNumbers: true,
          });
          editor.setSize("600", "600");
        </script>
        <!-- This is for getting the content o the test -->
        <div id="dom-target" style="display: none;">
          <?php
          $output = $tarea['codigou'];
          echo htmlspecialchars($output);
          ?>
        </div>
        
      <?php } ?>
    <?php } ?>
  </div>

</main>
 <script src="js/script.js"></script>

<?php
require_once 'includes/footer.php';
?>