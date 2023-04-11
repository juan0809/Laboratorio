<?php
if (!empty($_GET['curso'])||!empty($_GET['alumno'])) {
  $curso = $_GET['curso'];
  $alumno = $_GET['alumno'];
} else {
  header("Location: profesor");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idProfesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM notas as n INNER JOIN ev_entregadas as ev_e ON n.ev_entregada_id 
INNER JOIN alumnos as al ON ev_e.alumno_id =al.alumno_id INNER JOIN evaluaciones as ev ON
ev_e.evaluacion_id=ev.evaluacion_id INNER JOIN contenidos as c ON  ev.contenido_id=c.contenido_id 
INNer JOIN profesor_materia as pm ON c.pm_id =pm.pm_id  WHERE al.alumno_id=$alumno AND pm.pm_id =$curso";
$query = $pdo->prepare($sql);
$query->execute(array($alumno,$curso));
$rowc = $query->rowCount();
?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i>Notas estudiantes</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Notas</a></li>
    </ul>
  </div>
  <div class="row"> 
        <div class="col-md-12">
          <div class="tile">
             <div class="tile-body">
               <div class="table-responsive">
                  <table class="table-responsive">
                    <thead>
                      <tr>
                        <th>Evaluacion</th>
                        <th>Nota</th>
                      </tr>
                   </thead>
                 <tbody>
                   <?php if($rowc > 0){
                    while($data = $queryc->fetch()){
                    ?>
                    <tr>
                      <td> <?= $data['titulo'] ?> </td>
                      <td> <?= $data['Valor_nota'] ?> </td>
                    </tr>
                    <?php } } ?>
                 </tbody>

            </table>
            
            </div>
            
            </div>
          </div>
        </div>

  </div>

  <div class="row">
    <a href="index.php" class="btn btn-info">
      << Volver Atras</a>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>