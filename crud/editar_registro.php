<?php
include 'conexion.php';

$tabla = $_GET['tabla'];
$id = $_GET['id'];

// Obtener columnas
$cols = [];
$res = $conexion->query("DESCRIBE $tabla");
while ($col = $res->fetch_assoc()) {
    $cols[] = $col['Field'];
}
$pk = $cols[0]; // Suponiendo que la PK es la primera columna

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    foreach ($cols as $col) {
        if ($col !== $pk) {
            $valor = $conexion->real_escape_string($_POST[$col]);
            $updates[] = "$col='$valor'";
        }
    }
    $sql = "UPDATE $tabla SET " . implode(',', $updates) . " WHERE $pk='$id'";
    $conexion->query($sql);
    header("Location: listar_tabla.php?tabla=$tabla");
    exit;
}

// Obtener datos actuales
$row = $conexion->query("SELECT * FROM $tabla WHERE $pk='$id'")->fetch_assoc();

echo "<h2>Editar registro en $tabla</h2>";
echo "<form method='POST'>";
foreach ($cols as $col) {
    $readonly = $col === $pk ? "readonly" : "";
    echo "<label>$col:</label>";
    echo "<input type='text' name='$col' value='" . htmlspecialchars($row[$col]) . "' $readonly><br>";
}
echo "<input type='submit' value='Guardar'>";
echo "</form>";
echo "<a href='listar_tabla.php?tabla=$tabla'>Volver</a>";
?>
