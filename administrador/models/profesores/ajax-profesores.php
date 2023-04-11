<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) ||  empty($_POST['correo'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idprofesor = $_POST['idprofesor'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM profesor WHERE cedula = ? AND profesor_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idprofesor));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0) {
            $respuesta = array('status' => false,'msg' => 'El profesor ya existe');
        } else {
            if($idprofesor < 0) {
                $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO profesor (nombre,apellido,cedula,clave,correo,estado) VALUES (?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$apellido,$cedula,$clave,$correo,$estado));
                $accion = 1;
            } else {
                if(empty($_POST['clave'])) {
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?,apellido = ?,cedula = ?,correo = ?,estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$apellido,$cedula,$correo,$estado,$idprofesor));
                    $accion = 2;
                } else {
                    $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?,apellido = ?,cedula = ?,clave = ?,correo = ?,estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$apellido,$cedula,$claveUpdate,$correo,$estado,$idprofesor));
                    $accion = 3;
                }
            }  

            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Profesor creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Profesor actualizado correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}