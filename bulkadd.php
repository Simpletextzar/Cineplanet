<?php
include 'conexion.php'; // Adjust if needed

$id_sala_cine = 17;
$id_estado = 1;

$rows = range('A', 'H');       // Filas A to H
$columns = range(1, 10);       // Columnas 1 to 10

$insert_sql = "INSERT INTO asientos (fila, columna, id_sala_cine, id_estado) VALUES ";

$values = [];
foreach ($rows as $fila) {
    foreach ($columns as $columna) {
        $values[] = "('$fila', $columna, $id_sala_cine, $id_estado)";
    }
}

$insert_sql .= implode(", ", $values);

// Ejecutar el query
if ($mysqli->query($insert_sql)) {
    echo "✅ Se insertaron " . count($values) . " asientos correctamente.";
} else {
    echo "❌ Error: " . $mysqli->error;
}

$mysqli->close();
?>
