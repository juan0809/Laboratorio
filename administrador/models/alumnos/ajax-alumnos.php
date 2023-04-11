<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['nombre']) ||empty($_POST['apellido']) ||empty($_POST['cedula']) ||empty($_POST['correo'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $estado = $_POST['listEstado'];
        $sql = 'SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0) {
            $respuesta = array('status' => false,'msg' => 'El alumno ya existe');
        } else {
            if($idalumno < 0) {
                $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,apellido,cedula,clave,correo,estado) VALUES (?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$apellido,$cedula,$clave,$correo,$estado));
                $accion = 1;
            } else {
                    if(empty($_POST['clave'])) {
                        $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,apellido = ?,cedula = ?,correo = ?,estado = ? WHERE alumno_id = ?';
                        $queryUpdate = $pdo->prepare($sqlUpdate);
                        $request = $queryUpdate->execute(array($nombre,$apellido,$cedula,$correo,$estado,$idalumno));
                        $accion = 2;
                    } else {
                        $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                        $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,apellido = ?,cedula = ?,clave = ?,correo = ?,estado = ? WHERE alumno_id = ?';
                        $queryUpdate = $pdo->prepare($sqlUpdate);
                        $request = $queryUpdate->execute(array($nombre,$apellido,$cedula,$claveUpdate,$correo,$estado,$idalumno));
                        $accion = 3;
                    }
            }  

            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Alumno creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Alumno actualizado correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}