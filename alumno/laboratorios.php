<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

require_once '../includes/conexion.php';
$idAlumno = $_SESSION['alumno_id'];
$sql = "SELECT * FROM alumno_profesor as ap
INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id
INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id 
INNER JOIN grados as g ON pm.grado_id = g.grado_id 
INNER JOIN aulas as a  ON pm.aula_id = a.aula_id 
INNER JOIN profesor as p  ON pm.profesor_id = p.profesor_id 
INNER JOIN materias as m ON pm.materia_id = m.materia_id 
WHERE  al.alumno_id =$idAlumno";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();


?>

<main class="app-content">
  <div class="row">
    <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4" >Gestion de laboratorios</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>Mis Laboratorios</h4>
      
    </div>
  </div>
  <div class="row">
        <?php if($row >0 ){
          while($data = $query->fetch()){
        ?>
        <div class="col-md-4 text-center border mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 18rem";>
              <img src="images/pila.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center"><?=$data['nombre_materia'] ?> - pilas</h4>
                <h5 class="card-title"> Grado <kbd class="bg-info"><?= $data['nombre_grado'] ?></kbd> - Aula 
                <kbd class="bg-info"><?=$data['nombre_aula']?></kdb></h5> 
                <a href="gestion-lab.php?id=1&materia=<?= $data['materia_id']?>" class="btn btn-primary">Acceder</a>
              </div>
            </div>
        </div>

        <div class="col-md-4 text-center border mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 18rem";>
              <img src="images/cola.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center"><?=$data['nombre_materia'] ?>- colas</h4>
                <h5 class="card-title"> Grado <kbd class="bg-info"><?= $data['nombre_grado'] ?></kbd> - Aula 
                <kbd class="bg-info"><?=$data['nombre_aula']?></kdb></h5> 
                <a href="gestion-lab.php?id=2&materia=<?= $data['materia_id']?>"class="btn btn-primary">Acceder</a>
              </div>
            </div>
        </div>
        <div class="col-md-4 text-center border mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 18rem";>
              <img src="images/array.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center"><?=$data['nombre_materia'] ?>- array</h4>
                <h5 class="card-title"> Grado <kbd class="bg-info"><?= $data['nombre_grado'] ?></kbd> - Aula 
                <kbd class="bg-info"><?=$data['nombre_aula']?></kdb></h5> 
                <a href="gestion-lab.php?id=3&materia=<?= $data['materia_id']?>" class="btn btn-primary">Acceder</a>
              </div>
            </div>
        </div>
        <?php }  } ?>

      </div>  
</main>

<?php
require_once 'includes/footer.php'
?>