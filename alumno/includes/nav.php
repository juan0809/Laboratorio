<?php
  require_once '../includes/conexion.php';
  $idAlumno = $_SESSION['alumno_id'];
  $sql = "SELECT * FROM alumno_profesor as ap
  INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id
  INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id 
  INNER JOIN profesor as p  ON pm.profesor_id = p.profesor_id 
  INNER JOIN materias as m ON pm.materia_id = m.materia_id 
  WHERE  al.alumno_id =$idAlumno";
  $query = $pdo->prepare($sql);
  $query->execute();
  $row = $query->rowCount();

?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/user.png" alt="User Image">
        <div>
        <p class="app-sidebar__user-name"><?= $_SESSION['nombre_alumno'] ?></p>
          <p class="app-sidebar__user-designation">Alumno</p>
        </div>
      </div>
      <ul class="app-menu">
      <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Mis Cursos</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php if($row > 0){
                  while($data = $query->fetch()){
              ?>
                <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id']?>"><i class="icon fa fa-cicle-o"></i><?= $data['nombre_materia'];?></a></li>
                <li><a class="treeview-item" href="Lista_Laboratorios.php"></i><span class="app-menu__label">Laboratorios</span>
              </a></a></li>
                
          <?php } } ?>
        </ul>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>