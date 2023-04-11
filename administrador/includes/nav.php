 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/user.png" alt="User Image">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
      <li><a class="app-menu__item" href="lista_usuarios.php"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Aministradores</span></a></li>
      <li><a class="app-menu__item" href="lista_profesores.php"><i class="app-menu__icon fas fa-chalkboard-teacher"></i><span class="app-menu__label">Profesores</span></a></li>
      <li><a class="app-menu__item" href="lista_alumnos.php"><i class="app-menu__icon fas fa-user-graduate"></i><span class="app-menu__label">Alumnos</span></a></li>
      <li><a class="app-menu__item" href="lista_materias.php"><i class="app-menu__icon bi bi-book-fill"></i><span class="app-menu__label">Materias</span></a></li>
      <li><a class="app-menu__item" href="lista_profesor_materia.php"><i class="app-menu__icon bi bi-box2-fill"></i></i><span class="app-menu__label">Profesor Materia</span></a></li>
      <li><a class="app-menu__item" href="lista_alumno_profesor.php"><i class="app-menu__icon bi bi-people-fill"></i><span class="app-menu__label">Alumno Profesor</span></a></li>
      <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>