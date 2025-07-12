<?php
// get_fechas.php
// Trae las fechas disponibles para la película, cine elegido

if (!isset($_POST['id_cine']) || !isset($_POST['id_pelicula'])) {
    exit("Faltan parámetros");
}

$id_cine = $_POST['id_cine'];
$id_pelicula = $_POST['id_pelicula'];

// Conexión
include 'conexion.php';

$sql = "
    SELECT DISTINCT funciones.fecha
    FROM funciones
    JOIN salas_cine ON funciones.id_sala_cine = salas_cine.id_sala_cine
    WHERE salas_cine.id_cine = ? AND funciones.id_pelicula = ?
    ORDER BY funciones.fecha
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $id_cine, $id_pelicula);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Seleccione Fecha</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['fecha'].'">'.$row['fecha'].'</option>';
}

$stmt->close();
$mysqli->close();
