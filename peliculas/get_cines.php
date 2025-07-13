<?php
// get_cines.php
// Trae los cines que tienen la película, filtrado por ciudad

if (!isset($_POST['id_ciudad']) || !isset($_POST['id_pelicula'])) {
    exit("Faltan parámetros");
}

$id_ciudad = $_POST['id_ciudad'];
$id_pelicula = $_POST['id_pelicula'];

// Conexión
include '../conexion.php'; 

$sql = "
    SELECT DISTINCT cines.id_cine, cines.nombre
    FROM cines
    JOIN salas_cine ON cines.id_cine = salas_cine.id_cine
    JOIN funciones ON salas_cine.id_sala_cine = funciones.id_sala_cine
    WHERE cines.id_ciudad = ? AND funciones.id_pelicula = ?
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $id_ciudad, $id_pelicula);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Seleccione Cine</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['id_cine'].'">'.htmlspecialchars($row['nombre']).'</option>';
}

$stmt->close();
$mysqli->close();
