<?php
// get_horarios.php
// Trae horarios agrupados por Formato, Sala, Idioma para la película, cine y fecha

if (!isset($_POST['id_cine']) || !isset($_POST['id_pelicula']) || !isset($_POST['fecha'])) {
    exit("Faltan parámetros");
}

$id_cine = $_POST['id_cine'];
$id_pelicula = $_POST['id_pelicula'];
$fecha = $_POST['fecha'];

// Conexión
include '../conexion.php'; 
$sql = "
    SELECT 
        funciones.id_funcion,
        funciones.hora,
        funciones.formato,
        funciones.version_idioma,
        tipos_salas_cine.nombre AS nombre_sala
    FROM funciones
    JOIN salas_cine ON funciones.id_sala_cine = salas_cine.id_sala_cine
    JOIN tipos_salas_cine ON funciones.id_tipo_sala_cine = tipos_salas_cine.id_tipo_sala_cine
    WHERE salas_cine.id_cine = ?
    AND funciones.id_pelicula = ?
    AND funciones.fecha = ?
    ORDER BY funciones.formato, tipos_salas_cine.nombre, funciones.version_idioma, funciones.hora;
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iis", $id_cine, $id_pelicula, $fecha);
$stmt->execute();
$result = $stmt->get_result();

// Agrupa resultados en array
$grupos = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['formato'] . '|' . $row['nombre_sala'] . '|' . $row['version_idioma'];
    $grupos[$key][] = [
        'hora' => $row['hora'],
        'id_funcion' => $row['id_funcion']
    ];
}

// Genera HTML agrupado
if (count($grupos) === 0) {
    echo "<p>No hay funciones disponibles para la fecha seleccionada.</p>";
} else {
    foreach ($grupos as $clave => $horarios) {
        list($formato, $sala, $idioma) = explode('|', $clave);
        echo "<h3>Formato: ".htmlspecialchars($formato)."</h3>";
        echo "<h4>Sala: ".htmlspecialchars($sala)."</h4>";
        echo "<h4>Idioma: ".htmlspecialchars($idioma)."</h4>";

        foreach ($horarios as $h) {
            $hora = substr($h['hora'], 0, 5); // Quita segundos
            echo '<button type="button" class="horario-btn" data-id_funcion="'.$h['id_funcion'].'">'.$hora.'</button> ';
        }

        echo "<hr>";
    }
}

$stmt->close();
$mysqli->close();
