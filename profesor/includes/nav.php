<?php
  require_once '../includes/conexion.php';

  $idprofesor = $_SESSION['profesor_id'];

  $sql = "SELECT * FROM profesor_materia as pm 
  INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
  INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm !=0 AND pm.profesor_id =
  $idprofesor";
  $query = $pdo->prepare($sql);
  $query->execute();
  $row = $query->rowCount();

  $sqln = "SELECT * FROM profesor_materia as pm 
  INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
  INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm !=0 AND pm.profesor_id =
  $idprofesor";
  $queryn = $pdo->prepare($sqln);
  $queryn->execute();
  $rown = $queryn->rowCount();


  $sqln = "SELECT * FROM profesor_materia as pm 
  INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
  INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm !=0 AND pm.profesor_id =
  $idprofesor";
  $queryn = $pdo->prepare($sqln);
  $queryn->execute();
  $rown = $queryn->rowCount();

  $sqle = "SELECT * FROM profesor_materia as pm 
  INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
  INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm !=0 AND pm.profesor_id =
  $idprofesor";
  $querye = $pdo->prepare($sqle);
  $querye->execute();
  $rowe = $querye->rowCount();

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/user.png" alt="User Image">
        <div>
        <p class="app-sidebar__user-name"><?= $_SESSION['nombre'] ?></p>
          <p class="app-sidebar__user-designation">Profesor</p>
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
                <li><a class="app-menu__item" href="Lista_Laboratorios.php"></i><span class="app-menu__label">Laboratorios</span></a></li>
                <?php } } ?>
        </ul>

        <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon bi bi-envelope-fill"></i>
            <span class="app-menu__label">Entregas</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php if($rowe > 0){
                  while($datae = $querye->fetch()){
              ?>
                <li><a class="treeview-item" href="notas.php?curso=<?= $datae['pm_id']?>"><i class="icon fa fa-cicle-o"></i><?= $datae['nombre_materia'];?></a></li>
                <?php } } ?>
        </ul>

        <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon bi bi-clipboard2-fill"></i>
            <span class="app-menu__label">Calificaciones</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php if($rown > 0){
                  while($datan = $queryn->fetch()){
              ?>
                <li><a class="treeview-item" href="notas.php?curso=<?= $datan['pm_id']?>"><i class="icon fa fa-cicle-o"></i><?= $datan['nombre_materia'];?></a></li>
                <?php } } ?>
        </ul>

        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>