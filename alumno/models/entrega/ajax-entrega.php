<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idevaluacion = $_POST['idevaluacion'];
    $idalumno = $_POST['idalumno'];
    $observacion = $_POST['observacion'];
    $material=$_FILES['file']['name'];
    $type=$_FILES['file']['type'];
    $url_temp=$_FILES['file']['tmp_name'];

    $directorio='../../../uploads/'.rand(1000,10000);
    if(!file_exists($directorio)){
      mkdir($directorio,077,true);

    }
    $destino=$directorio.'/'.$material;    
  
    if($_FILES['file']['size']>1500000){
        $respuesta=array('status'=>false,'msg'=>'solo se permiten archivos de 15mb');
    }
    else {

    $sqlInsert = 'INSERT INTO ev_entregadas(evaluacion_id,alumno_id,material,observacion) VALUES (?,?,?,?)';
    $queryInsert = $pdo->prepare($sqlInsert);
    $request = $queryInsert->execute(array($idevaluacion,$idalumno,$destino,$observacion));
    move_uploaded_file($url_temp,$destino);
    if($request){
        $respuesta = array('status' => true, 'msg' => 'Entrega creada correctamente');
    }else{
        $respuesta = array('status' => false, 'msg' => 'No es posible crear la entrega');
    }
}
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>