<?php
$mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
session_start();
$id_pelicula = 11;
$query = "
    SELECT c.id_cine, c.nombre AS cine_nombre, c.direccion, ci.id_ciudad, ci.nombre AS ciudad_nombre
    FROM cines c
    JOIN salas_cine sc ON sc.id_cine = c.id_cine
    JOIN funciones f ON f.id_sala_cine = sc.id_sala_cine
    JOIN ciudades ci ON c.id_ciudad = ci.id_ciudad
    WHERE f.id_pelicula = $id_pelicula
    GROUP BY c.id_cine
";
$cines_result = $mysqli->query($query);

$cines = [];
if ($cines_result && $cines_result->num_rows > 0) {
    while ($cine = $cines_result->fetch_assoc()) {
        // Obtenemos funciones y cines para la pelicula
        $funciones_query = "
            SELECT f.id_funcion, f.hora, f.fecha, f.formato, f.version_idioma, f.precio
            FROM funciones f
            JOIN salas_cine sc ON f.id_sala_cine = sc.id_sala_cine
            WHERE sc.id_cine = {$cine['id_cine']} AND f.id_pelicula = $id_pelicula
            ORDER BY f.fecha, f.hora
        ";
        $funciones_result = $mysqli->query($funciones_query);
        $funciones = [];
        if ($funciones_result && $funciones_result->num_rows > 0) {
            while ($funcion = $funciones_result->fetch_assoc()) {
                $funciones[] = $funcion;
            }
        }
        $cine['funciones'] = $funciones;
        $cines[] = $cine;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineplanet</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/movie.css">
</head>
<body>
    <div id="root">
        <div class="home-page">
            <div class="hero-header">
                <div class="header">
                    <div class="header--content">
                        <div class="header_large">
                            <a href="../index.html" class="header--logo-container">
                                <img class="header--logo" src="../img/logo/Cineplanet_logo.svg">
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
                        <h1 class="title-container--title">Cómo entrenar a tu dragón</h1>
                    </div>
                    <div class="movie-detail-grid">
                        <div class="movie-grid--movie-photo">
                            <img src="https://cdn.apis.cineplanet.com.pe/CDN/media/entity/get/FilmPosterGraphic/HO00002334?referenceScheme=HeadOffice&allowPlaceHolder=true">
                        </div>
                        <div class="movie-grid--sinopsis">
                            <h2>Sinopsis</h2>
                            <p>En la isla de Berk, donde los vikingos y los dragones han sido enemigos por generaciones, Hipo se distingue. 
                                El ingenioso, pero olvidado, hijo del Jefe Estoico el Vasto, Hipo desafía siglos de tradición cuando hace amistad 
                                con Chimuelo, el temido dragón Furia Nocturna. Su vínculo inusual revela la verdadera naturaleza de los dragones, 
                                retando las fundaciones de la sociedad vikinga.</p>
                        </div>
                         
                    </div>
                </div>
            </div>
            <div class="container container_standard movie_container">
                <div class="container-content">
                    <div class="title-container">
                        <h1 class="title-container--title">Elegir cine</h1>
                    </div>
                    <div class="cinema-showcase-grid">

                    <?php foreach ($cines as $cine): ?>
                        <div class="cinema-showcase">
                            <h3 class="cinema-showcase--name"><?= htmlspecialchars($cine['cine_nombre']) ?> (<?= htmlspecialchars($cine['ciudad_nombre']) ?>)</h3>
                            <p><?= htmlspecialchars($cine['direccion']) ?></p>
                            <div class="cinema-showcase--details">
                                <?php if (count($cine['funciones']) > 0): ?>
                                    <?php foreach ($cine['funciones'] as $funcion): ?>
                                        <div class="showtime-selector">
                                            <a class="button-showtime-selector"
                                               href="../asientos.php?id_pelicula=<?= $id_pelicula ?>&id_funcion=<?= $funcion['id_funcion'] ?>&id_ciudad=<?= $cine['id_ciudad'] ?>">
                                                <?= date("d/m h:i a", strtotime($funcion['fecha'] . ' ' . $funcion['hora'])) ?>
                                                <?= htmlspecialchars($funcion['formato']) ?> <?= htmlspecialchars($funcion['version_idioma']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span>No hay funciones disponibles.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>