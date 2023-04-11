<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['listProfesor']) || empty($_POST['listGrado']) || empty($_POST['listAula']) || empty($_POST['listMateria']) || empty($_POST['listPeriodo'])) {
        $response = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idprofesormateria = $_POST['idprofesormateria'];
        $profesor = $_POST['listProfesor'];
        $materia = $_POST['listMateria'];
        $status = $_POST['listEstado'];
        // CONSULTA PARA INSERTAR
        $sql = "SELECT * FROM profesor_materia WHERE profesor_id = ? AND materia_id = ?  AND estadopm != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($profesor,$grado,$aula,$materia,$periodo));
        $resultInsert = $query->fetch(PDO::FETCH_ASSOC);

        // CONSULTA PARA ACTUALIZAR
        $sql2 = "SELECT * FROM profesor_materia WHERE profesor_id = ? AND materia_id = ? AND estadopm != 0 AND pm_id != ?";
        $query2 = $pdo->prepare($sql2);
        $query2->execute(array($profesor,$grado,$aula,$materia,$periodo,$idprofesormateria));
        $resultUpdate = $query2->fetch(PDO::FETCH_ASSOC);

        if($resultInsert > 0) {
            $response = array('status' => false,'msg' => 'materia y el profesor ya existen, seleccione otro');
        } else {
            if($idprofesormateria < 0) {
                $sql_insert = "INSERT INTO profesor_materia (profesor_id,materia_id,estadopm) VALUES (?,?,?)";
                $query_insert = $pdo->prepare($sql_insert);
                $request = $query_insert->execute(array($profesor,$materia,$status));
                if($request) {
                    $response = array('status' => true,'msg' => 'Proceso creado correctamente'); 
                }
            }  
        }

        if($resultUpdate > 0) {
            $response = array('status' => false,'msg' => 'materia y el profesor ya existen, seleccione otro');
        } else {
            if($idprofesormateria < 0) {
                $sql_update = "UPDATE profesor_materia SET profesor_id = ?,materia_id = ?,estadopm = ? WHERE pm_id = ?";
                $query_update = $pdo->prepare($sql_update);
                $request2 = $query_update->execute(array($profesor,$materia,$status,$idprofesormateria));
                if($request2) {
                    $response = array('status' => true,'msg' => 'Proceso actualizado correctamente');
                }
            }
        }
    }
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
}