<?php
$mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id_sala_cine = 3;
$estado_libre = 1; // assuming 1 = libre

$rows = range('A', 'H'); // 8 rows: A to H
$cols = range(1, 10);    // 10 seats per row

foreach ($rows as $fila) {
    foreach ($cols as $columna) {
        $stmt = $mysqli->prepare("INSERT INTO asientos (fila, columna, id_estado, id_sala_cine) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $fila, $columna, $estado_libre, $id_sala_cine);
        $stmt->execute();
    }
}

echo "Asientos insertados correctamente.";
?>