<?php
include 'conexion.php';

$tabla = $_GET['tabla'];
$id = $_GET['id'];

// Obtener PK
$res = $conexion->query("DESCRIBE $tabla");
$pk = $res->fetch_assoc()['Field'];

$conexion->query("DELETE FROM $tabla WHERE $pk='$id'");
header("Location: listar_tabla.php?tabla=$tabla");
exit;
?>