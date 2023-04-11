<?php
if (!empty($_GET['curso']) || !empty($_GET['contenido'])) {
    $curso = $_GET['curso'];
    $contenido = $_GET['contenido'];
    $evaluacion = $_GET['eva'];
} else {
    header("Location: alumno");
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idAlumno = $_SESSION['alumno_id'];

$sqla = "SELECT * FROM  ev_entregadas as ev
INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id
INNER JOIN evaluaciones as eva ON ev.evaluacion_id = eva.evaluacion_id 
INNER JOIN contenidos  as c ON eva.contenido_id = c.contenido_id 
WHERE  ev.evaluacion_id = ? AND a.alumno_id= ?";
$querya = $pdo->prepare($sqla);
$querya->execute(array($evaluacion, $idAlumno));
$rowa = $querya->rowCount();
$sqlf = "SELECT * FROM evaluaciones WHERE contenido_id=$contenido AND evaluacion_id = $evaluacion";
$queryf = $pdo->prepare($sqlf);
$queryf->execute();
$result = $queryf->fetch();
date_default_timezone_set("America/Bogota");
$fecha = date('Y-m-d');
$fechaLimite = $result['fecha'];

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Realizar entregas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Asignar evaluacion</a></li>
        </ul>
    </div>
    <?php if ($rowa > 0) {
        while ($data = $querya->fetch()) {

            $porcentaje = '';
            $calificacion = '';
            $ev_entregada = $data['ev_entregada_id'];

            $sqln = "SELECT * FROM notas as n
            INNER JOIN ev_entregadas as ev ON n.ev_entregada_id =ev.ev_entregada_id
            INNER JOIN alumnos as a  ON  ev.alumno_id=a.alumno_id WHERE n.ev_entregada_id =$ev_entregada AND a.alumno_id
            =$idAlumno ";
            $queryn = $pdo->prepare($sqln);
            $queryn->execute();
            $datan = $queryn->rowCount();
            $nota = $queryn->fetch();

            if ($datan > 0) {
              
                $valor = '<kbd class="bg-sucess text-white p-1">Calificado</kbd>';
                $calificacion = $nota['valor_nota'];
            } else {
                $valor = '<kbd class="bg-sucess">Sin Calificar</kbd>';
                $calificacion = '';
            }
    ?>
            <div class="row mt-2 bg-success text-white p-2">
                <h3>Ya se realizo la entrega<h3>
            </div>
            <div class="row mt-3">
                <div table="table table-bordered">
                    <thead>
                        <tr>
                            <th>Estatus</th>
                            <th>Calificacion</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p><?= $valor; ?></p>
                            </td>
                            <td>
                                <p><?= $calificacion; ?></p>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            <?php }
    } else { ?>
            <?php if ($fecha < $fechaLimite) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Realizar entrega</h3>
                            <div class="tile-body">
                                <form class="form-horizontal" id="formEntrega" name="formEntrega" enctype="multipart/form-data">
                                    <input type="hidden" name="idevaluacion" id="idevaluacion" value="<?=$evaluacion; ?>">
                                    <input type="hidden" name="idalumno" id="idalumno" value="<?=$idAlumno; ?>">   

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Descripcion de la Actividad</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="observacion" id="observacion" rows="4" placeholder="Descripcion"></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Adjuntar entrega</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control-file" name="file" id="file">

                                        </div>
                                    </div>
                                    <div class="tile-footer">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-3">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fa fa-fw fa-lg fa-check-circle">

                                                </i>Enviar</button>&nbsp;&nbsp;&nbsp;

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="row bg-danger p-3 text-white">
                    <h5>Ya no se puede hacer entregas la fecha (fechaLimite)<?= $fechaLimite; ?></h5>
                </div>

            <?php } ?>
        <?php } ?>

        <div class="row">
        </div>
</main>
<?php
require_once 'includes/footer.php';
?>s