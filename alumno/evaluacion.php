<?php
if (!empty($_GET['curso']) || !empty($_GET['contenido'])) {
    $curso = $_GET['curso'];
    $contenido = $_GET['contenido'];
} else {
    header("Location: alumno");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
$idAlumno = $_SESSION['alumno_id'];
$sql = "SELECT *,date_format(fecha, '%d/%m/%Y')as fecha From evaluaciones
     WHERE contenido_id=$contenido";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Ver evaluacion</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Asignar evaluacion</a></li>
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
                            <p> <a class="btn btn-warning icon-btn" href="entregas.php?curso=<?= $curso; ?>&contenido=<?= $data['contenido_id']; ?>&eva=<?= $data['evaluacion_id']; ?>">
                                    <i class="fa fa-flag"></i>Realizar entregas</button> <a></a>
                            </p>    
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

    <div class="row">
        <a href="index.php" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>