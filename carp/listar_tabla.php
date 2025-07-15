<?php
include 'conexion.php';

$tabla = $_GET['tabla'];
$result = $conexion->query("SELECT * FROM $tabla");

echo "<h2>Registros de la tabla: $tabla</h2>";
echo "<a href='formulario_dinamico.php?tabla=$tabla'>Insertar nuevo</a><br><br>";

echo "<table border='1'><tr>";
// Encabezados
while ($col = $result->fetch_field()) {
    echo "<th>{$col->name}</th>";
}
echo "<th>Acciones</th></tr>";

// Filas
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $valor) {
        echo "<td>$valor</td>";
    }
    // Botones de editar y eliminar
    $pk = array_values($row)[0]; // Suponiendo que la PK es la primera columna
    echo "<td>
        <a href='editar_registro.php?tabla=$tabla&id=$pk'>Editar</a> |
        <a href='eliminar_registro.php?tabla=$tabla&id=$pk' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
    </td>";
    echo "</tr>";
}
echo "</table>";
echo "<br><a href='seleccionar_tabla.php'>Volver</a>";
?>
