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
  <img src="images/laboratorios/<?=$data['imagen'] ?>" width="25%" alt="<?= $data['titulo']; ?>">
  </div>
  <div>
  <h5> <p><?= $data['descripcion']; ?> </p></H5>
  </div>
  <div>
    <p class="font-weight-bold">Objetivos:</p>
    <H5> <P><?= $data['objetivos']; ?></P></H5>
  </div>

  <!-- Lista de tareas -->
    <div>
    <?php foreach ($tareas as $tarea) { ?>
        <?php if (!empty($tarea['titulo_tarea'])) { ?>
            <h5>Tarea: <?= $tarea['titulo_tarea']; ?></h5>
        <?php } ?>

        <?php if (!empty($tarea['imagen_tarea'])) { ?>
          <img src="images/tareas/<?=$tarea['imagen_tarea'] ?>" width="25%" alt="<?= $tarea['titulo_tarea']; ?>">
        <?php } ?>

        <?php if (!empty($tarea['descripcion_tarea'])) { ?>
          </H2><p><?= $tarea['descripcion_tarea']; ?></p></H2>
        <?php } ?>

        <?php if (!empty($tarea['codigo'])) { ?>
          <p>Código</p>
            <textarea name="code_codigo" id="" cols="50" rows="10"><?= $tarea['codigo']; ?></textarea>
        <?php } ?>

        <?php if (!empty($tarea['codigou'])) { ?>
            <p>Código U:</p>
            <textarea name="code_codigo" id="" cols="50" rows="10"><?= $tarea['codigou']; ?></textarea> 
        <?php } ?>
    <?php } ?>
    </div>

</main>

<?php
require_once 'includes/footer.php';
?>