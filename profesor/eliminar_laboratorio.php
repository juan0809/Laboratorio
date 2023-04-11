
<?php
require_once '../includes/conexion.php';
//se recibe el id del laboratorio a eliminar
$laboratorio = $_GET['laboratorio'];
//se crea la consulta para eliminar el laboratorio
$sql = "DELETE FROM laboratorios WHERE id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
//se crea la consulta para eliminar las tareas asociadas al laboratorio
$sql = "DELETE FROM tareas WHERE laboratorio_id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
//se redirecciona a la lista de laboratorios
header("Location: Lista_Laboratorios.php");
?>

