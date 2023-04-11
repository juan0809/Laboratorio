<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('Location: administrador/');
} else if (!empty($_SESSION['activeP'])) {
    header('Location: profesor/');
} else if (!empty($_SESSION['activeA'])) {
    header('Location: alumno/');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Gestion de Laboratorios</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <title>INGRESO AL SISTEMA</title>
</head>

<body>
    <header class="main-header">

        <div class="main-cont">
            <div class="desc-header">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="images/login.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="images/imagen2.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/php-hd.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p>Gestion de laboratorios</p>
            </div>
        </div>
        <div class="cont-header">
            <h1>INGRESO</h1>

            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="alumno-tab" data-toggle="tab" href="#alumno" role="tab"
                        aria-controls="alumno" aria-selected="true">Alumno</a>
                </li>


                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Profesor</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="false">Administrador</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade" id="alumno" role="tabpanel" aria-labelledby="alumno-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuarioAlumno" id="usuarioAlumno" placeholder="Cedula">
                        <label for="password">Contraseña</label>
                        <input type="password" name="passAlumno" id="passAlumno" placeholder="Contraseña">
                        <div id="messageAlumno"></div>
                        <button id="loginAlumno" type="button">INICIAR SESION</button>
                    </form>
                </div>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                        <label for="password">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña">
                        <div id="messageUsuario"></div>
                        <button id="loginUsuario" type="button">INICIAR SESION</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuarioProfesor" id="usuarioProfesor" placeholder="Cedula">
                        <label for="password">Contraseña</label>
                        <input type="password" name="passProfesor" id="passProfesor" placeholder="Contraseña">
                        <div id="messageProfesor"></div>
                        <button id="loginProfesor" type="button">INICIAR SESION</button>
                    </form>
                </div>
            </div>
        </div>

    </header>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>