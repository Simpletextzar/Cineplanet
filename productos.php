<?php
$mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
if (isset($_GET['id_pelicula'])) {
    $_SESSION['id_pelicula'] = $_GET['id_pelicula'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['asientos'])) {
    $_SESSION['asientos'] = $_POST['asientos'];
    // Optionally redirect or show a confirmation
    // header('Location: confirmacion.php');
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/movie.css">
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
                                <li class="header--main-menu-item">
                                    <a class="header--main-menu-link">Películas</a>
                                </li>
                                <li class="header--main-menu-item">
                                    <a class="header--main-menu-link">Cines</a>
                                </li>
                                <li class="header--main-menu-item">
                                    <a class="header--main-menu-link">Dulcería</a>
                                </li>
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
                    <?php
                        $id_sala = 3; // change this dynamically if needed
                        $query = "
                            SELECT fila, columna, estado_nombre 
                            FROM asientos 
                            INNER JOIN asientos_estados ON asientos.id_estado = asientos_estados.id_estado 
                            WHERE id_sala_cine = $id_sala 
                            ORDER BY fila ASC, columna ASC
                        ";

                        $result = $mysqli->query($query);

                        // Organize seats by rows (fila)
                        $seats_by_row = [];

                        while ($row = $result->fetch_assoc()) {
                            $fila = $row['fila'];
                            $columna = $row['columna'];
                            $estado = strtolower($row['estado_nombre']); // e.g. libre, ocupado
                        
                            if (!isset($seats_by_row[$fila])) {
                                $seats_by_row[$fila] = [];
                            }
                        
                            $seats_by_row[$fila][$columna] = $estado;
                        }
                    ?>

                    <div class="seat-legend">
                        <span class="seat libre"></span> Libre
                        <span class="seat ocupado"></span> Ocupado
                    </div>
                    <div class="seat-legend--screen">
                        <h2>Pantalla</h2>
                    </div>


<form class="seat-form" method="POST" action="">
    <div class="seat-grid">
        <?php foreach ($seats_by_row as $fila => $columnas): ?>
            <div class="seat-row">
                <span class="seat-label"><?= htmlspecialchars($fila) ?></span>
                <?php foreach ($columnas as $col => $asiento): ?>
                    <?php
                        $estado = is_array($asiento) ? $asiento['estado'] : $asiento;
                        $id_asiento = is_array($asiento) ? $asiento['id_asiento'] : "$fila$col";
                        $disabled = ($estado !== 'libre') ? 'disabled' : '';
                    ?>
                    <label class="seat <?= $estado ?>">
                        <input type="checkbox" name="asientos[]" value="<?= htmlspecialchars($id_asiento) ?>" <?= $disabled ?>>
                        <span><?= $col ?></span>
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