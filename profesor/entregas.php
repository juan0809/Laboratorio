<?php
if (!empty($_GET['curso']) || !empty($_GET['contenido']) || !empty($_GET['eva'])) {
  $curso = $_GET['curso'];
  $contenido = $_GET['contenido'];
  $evaluacion = $_GET['eva'];
} else {
  header("Location: profesor");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
//require_once '../includes/funciones.php';
//require_once 'includes/modals/modal_evaluacion.php';
$idProfesor = $_SESSION['profesor_id'];
$sql = "SELECT *,date_format(fecha, '%d/%m/%Y')as fecha From evaluaciones
WHERE contenido_id=$contenido AND evaluacion_id = $evaluacion";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

$sqla = "SELECT * FROM  ev_entregadas as ev
    INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id
    INNER JOIN evaluaciones as eva ON ev.evaluacion_id = eva.evaluacion_id 
    INNER JOIN contenidos  as c ON eva.contenido_id = c.contenido_id 
    WHERE  ev.evaluacion_id = $evaluacion";
$querya = $pdo->prepare($sqla);
$querya->execute();
$rowa = $querya->rowCount();
date_default_timezone_set("America/Bogota");
$fecha=date('Y-m-d')
?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Evaluaciones entregadas</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Evaluaciones entregadas</a></li>
    </ul>
  </div>
  <div class="row">
    <?php if ($row > 0) {
      while ($data = $query->fetch()) {
        ?>
        <div class="col-md-12">
          <div class="tile">
            <div class="title-title-w-btn">
              <h3 class="title">
                <?= $data['titulo']; ?>
              </h3>
            </div>
            <div class="title-body">
              <b>
                <?= $data['descripcion']; ?>
              </b><br> <br>
              <b>
                <?= $data['fecha']; ?>
              </b><br> <br>
              <b>
                <?= $data['porcentaje']; ?>
              </b><br> <br>
            </div>
          </div>
        </div>
      </div>
      </div>
    <?php }
    } ?>
  </div>

  <div class="row mt-2 bg-secondary text-white p-2">
    <h3> Evaluaciones entregadas</h3>
  </div>

  <div class="row mt-3">
  <?php if ($rowa > 0) {
    while ($data2 = $querya->fetch()) {
      $porcentaje = '';
      $cargar = '';
      $alumno = $data2['alumno_id'];
      $ev_entregada = $data2['ev_entregada_id'];
      $sqln = "SELECT * FROM  notas Where ev_entregada_id= $ev_entregada";
      $queryn = $pdo->prepare($sqln);
      $queryn->execute();
      $datan = $queryn->rowCount();
      if ($datan > 0) {
        $porcentaje = '<kbd class="bg-success">Calificado</kbd>';
        $cargar = '';
      } else {
        require_once 'includes/modals/modal_nota.php';
        $porcentaje = '<kbd class="bg-danger">Sin Calificar</kbd>';
        $cargar = '<button class="btn btn-warning" onclick="openModalNota()">Cargar nota</button>';
      }
      ?>
    <div class="col-md-12">
      <div class="tile">
        <table class="table table-bordered">
           <thead>
             <tr>
               <th>Alumno</th>
               <th>Observacion</th>
               <th>Material</th>
               <th>Estatus</th>
               <th>Cargar nota</th>
             </tr>
           </thead>
       <tbody>
              <td><?=$data2['nombre_alumno']?></td>
              <td><?=$data2['observacion']?></td>
              <td>
                <div class="input-group">
                 <div class="input-goup-prepend">
                  <div class="input-group-text"> <i class= "fa fa-download"></i>
                  </div>
                 </div>
                 <a class="btn btn-primary" href="BASE_URL<?=$data2['material'];?>"
                  target="_blank">Material</a>

              </div>
                
            
            </td>
              <td><?=$porcentaje?></td>
              <td><?=$cargar?></td>
       </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>

<?php }
} ?>
</div>
  <div class="row">
    <a href="contenido.php?curso=<?= $curso ?>" class="btn btn-info">
      << Volver Atras</a>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>