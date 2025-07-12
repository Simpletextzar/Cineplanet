<?php
$mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineplanet</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/movie.css">
    <link rel="stylesheet" href="css/seat.css">
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

                    <div class="seat-grid">
    <?php foreach ($seats_by_row as $fila => $columnas): ?>
        <div class="seat-row">
            <span class="seat-label"><?= htmlspecialchars($fila) ?></span>
            <?php foreach ($columnas as $col => $asiento): ?>
                <?php
                    // If $asiento is a string like "libre" or "ocupado", convert it to array form
                    $estado = is_array($asiento) ? $asiento['estado'] : $asiento;
                    $id_asiento = is_array($asiento) ? $asiento['id_asiento'] : "$fila$col";
                ?>
                <span class="seat <?= $estado ?>" 
                      data-id="<?= htmlspecialchars($id_asiento) ?>" 
                      data-fila="<?= htmlspecialchars($fila) ?>" 
                      data-columna="<?= htmlspecialchars($col) ?>">
                    <?= $col ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>



                </div>
            </div>
        </div>
    </div>
    <script src="js/seat.js"></script>
</body>
</html>