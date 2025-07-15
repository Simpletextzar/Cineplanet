<?php
session_start();
include 'conexion.php';

// Si hay asientos guardados, liberarlos
if (!empty($_SESSION['compra']['asientos'])) {
  foreach ($_SESSION['compra']['asientos'] as $id_asiento) {
    $sql = "UPDATE asientos SET id_estado = 1 WHERE id_asiento = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_asiento);
    $stmt->execute();
    $stmt->close();
  }
  // Limpiar asientos de sesión
  $_SESSION['compra']['asientos'] = [];
}
?>

<?php
include 'conexion.php';

// 🗂️ Lee el ID de función desde la sesión de compra
$id_funcion = isset($_SESSION['compra']['funcion']) ? intval($_SESSION['compra']['funcion']) : 0;

if ($id_funcion === 0) {
    die("No hay función seleccionada.");
}

// Trae ID de sala y capacidad de esa función
$sql_sala = "
    SELECT f.id_sala_cine, sc.capacidad
    FROM funciones f
    JOIN salas_cine sc ON f.id_sala_cine = sc.id_sala_cine
    WHERE f.id_funcion = ?
    LIMIT 1
";
$stmt = $mysqli->prepare($sql_sala);
$stmt->bind_param("i", $id_funcion);
$stmt->execute();
$result_sala = $stmt->get_result();
$sala_info = $result_sala->fetch_assoc();
$stmt->close();

$id_sala = $sala_info['id_sala_cine'];
$capacidad = $sala_info['capacidad'];

// Trae asientos para esa sala ordenados
$sql_asientos = "
    SELECT a.id_asiento, a.fila, a.columna, ae.estado_nombre 
    FROM asientos a
    JOIN asientos_estados ae ON a.id_estado = ae.id_estado
    WHERE a.id_sala_cine = ?
    ORDER BY a.fila ASC, a.columna ASC
    LIMIT ?
";
$stmt = $mysqli->prepare($sql_asientos);
$stmt->bind_param("ii", $id_sala, $capacidad);
$stmt->execute();
$result_asientos = $stmt->get_result();
$stmt->close();

// Organiza por fila
$seats_by_row = [];
while ($row = $result_asientos->fetch_assoc()) {
    $fila = $row['fila'];
    $columna = $row['columna'];
    $estado = strtolower($row['estado_nombre']);

    if (!isset($seats_by_row[$fila])) {
        $seats_by_row[$fila] = [];
    }

    $seats_by_row[$fila][$columna] = [
        'id_asiento' => $row['id_asiento'],
        'estado' => $estado
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cineplanet - Elegir Asientos</title>
  <link rel="stylesheet" href="reset.css" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="css/movie.css" />
  <link rel="stylesheet" href="css/seat.css" />
</head>
<body>
<div id="root">
  <div class="home-page">
    <div class="hero-header">
      <div class="header">
        <div class="header--content">
          <div class="header_large">
            <a href="index.html" class="header--logo-container">
              <img class="header--logo" src="img/logo/Cineplanet_logo.svg">
            </a>
            <ul class="header--main-menu" id="menu-text">
              <li class="header--main-menu-item"><a class="header--main-menu-link">Películas</a></li>
              <li class="header--main-menu-item"><a class="header--main-menu-link">Cines</a></li>
              <li class="header--main-menu-item"><a class="header--main-menu-link">Dulcería</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container container_standard movie_container">
      <div class="container-content">
        <div class="title-container">
          <h1 class="title-container--title">Elegir asientos</h1>
        </div>

        <div class="seat-legend">
          <span class="seat libre"></span> Libre
          <span class="seat ocupado"></span> Ocupado
          <span class="seat selected"></span> Seleccionado
        </div>

        <div class="seat-legend--screen">
          <h2>Pantalla</h2>
        </div>

        <!-- 👉 Formulario apunta a guardar_asientos.php -->
        <form class="seat-form" method="POST" action="guardar_asientos.php">
          <input type="hidden" name="id_funcion" value="<?= htmlspecialchars($id_funcion) ?>">
          <div class="seat-grid">
            <?php foreach ($seats_by_row as $fila => $columnas): ?>
              <div class="seat-row">
                <span class="seat-label"><?= htmlspecialchars($fila) ?></span>
                <?php foreach ($columnas as $col => $asiento): ?>
                  <?php
                    $estado = $asiento['estado'];
                    $id_asiento = $asiento['id_asiento'];
                    $disabled = ($estado !== 'libre') ? 'disabled' : '';
                  ?>
                  <label class="seat <?= $estado ?>">
                    <input type="checkbox" name="asientos[]" value="<?= htmlspecialchars($id_asiento) ?>" <?= $disabled ?>>
                    <span><?= htmlspecialchars($col) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="seat-form--button" type="submit">Reservar asientos</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script src="js/seat.js"></script>
</body>
</html>
