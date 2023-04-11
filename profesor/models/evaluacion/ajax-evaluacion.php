<?php

//agregar el archivo de conexion desde la carpeta includes
require_once '../../../includes/conexion.php';

$idevaluacion = $_POST['idevaluacion'];
$idcontenido = $_POST['idcontenido'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$porcentaje = $_POST['porcentaje'];

// se guarda o se actualiza la informacion
if(empty($idevaluacion)){
    $sql = 'INSERT INTO evaluaciones (titulo, descripcion, fecha, porcentaje, contenido_id) VALUES (?,?,?,?,?)';
    $request = $pdo->prepare($sql);
    $request->execute(array($titulo, $descripcion, $fecha, $porcentaje, $idcontenido));
    $accion=1;
}else{
    $sql = 'UPDATE evaluaciones SET titulo=?, descripcion=?, fecha=?, porcentaje=? WHERE evaluacion_id=?';
    $request = $pdo->prepare($sql);
    $request->execute(array($titulo, $descripcion, $fecha, $porcentaje, $idevaluacion));
    $accion=2;
}
//si se guarda la informacion se envia una respuesta
if($request){
    if ($accion == 1) {
        $respuesta = array('status' => true, 'msg' => 'Evaluacion creada correctamente');
    } else {
        $respuesta = array('status' => true, 'msg' => 'Evaluacion actualizada correctamente');
    }
}else{
    $respuesta = array('status' => false, 'msg' => 'No es posible crear la evaluacion');
}
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>