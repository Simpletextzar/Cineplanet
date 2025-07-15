<?php
include 'conexion.php';

$tabla = $_GET['tabla'];
$result = $conexion->query("DESCRIBE $tabla");

// Obtener claves foráneas de la tabla
$fkQuery = $conexion->query("
    SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '$tabla' AND REFERENCED_TABLE_NAME IS NOT NULL
");

$claves_foraneas = [];
while ($fk = $fkQuery->fetch_assoc()) {
    $claves_foraneas[$fk['COLUMN_NAME']] = [
        'tabla' => $fk['REFERENCED_TABLE_NAME'],
        'columna' => $fk['REFERENCED_COLUMN_NAME']
    ];
}

echo "<h2>Insertar datos en la tabla: $tabla</h2>";
echo "<form action='insertar_datos.php' method='POST'>";
echo "<input type='hidden' name='tabla' value='$tabla'>";

while ($columna = $result->fetch_assoc()) {
    $campo = $columna['Field'];
    $tipo = strtolower($columna['Type']);

    if ($columna['Extra'] !== 'auto_increment') {
        echo "<label>$campo:</label>";
        if (isset($claves_foraneas[$campo])) {
            $tabla_fk = $claves_foraneas[$campo]['tabla'];
            $columna_fk = $claves_foraneas[$campo]['columna'];
            $res_fk = $conexion->query("SELECT $columna_fk FROM $tabla_fk");

            echo "<select name='$campo' required>";
            echo "<option value=''>-- Selecciona una opción --</option>";
            while ($row = $res_fk->fetch_assoc()) {
                $valor = $row[$columna_fk];
                echo "<option value='$valor'>$valor</option>";
            }
            echo "</select><br>";
        } else {
            if (strpos($tipo, 'int') !== false) {
                echo "<input type='number' name='$campo' required><br>";
            } elseif (strpos($tipo, 'float') !== false || strpos($tipo, 'double') !== false || strpos($tipo, 'decimal') !== false) {
                echo "<input type='number' step='0.01' name='$campo' required><br>";
            } elseif (strpos($tipo, 'date') !== false && strpos($tipo, 'time') === false) {
                echo "<input type='date' name='$campo' required><br>";
            } elseif (strpos($tipo, 'time') !== false && strpos($tipo, 'date') === false) {
                echo "<input type='time' name='$campo' required><br>";
            } else {
                echo "<input type='text' name='$campo' required><br>";
            }
        }
    }
}

echo "<input type='submit' value='Insertar'>";
echo "</form>";
echo "<a href='listar_tabla.php?tabla=$tabla'>Volver</a>";
?>
