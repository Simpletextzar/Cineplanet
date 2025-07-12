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
                        <div class="cinema-showcase">
                            <h3 class="cinema-showcase--name">CP Tacna</h3>
                            <div class="cinema-showcase--formats">
                                <div class="cinema-showcase--formats-dimensions">
                                    <p>3D</p>
                                </div>
                                <div class="cinema-showcase--formats-theater">
                                    <p>REGULAR</p>
                                </div>
                                <div class="cinema-showcase--formats-language">
                                    <p>DOBLADA</p>
                                </div>
                            </div>
                            <div class="cinema-showcase--details">
                                <?php
                                $id_pelicula = 11;
                                $result = $mysqli->query("SELECT hora FROM funciones WHERE id_pelicula = 11 ORDER BY hora");
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $time = date("h:i a", strtotime($row["hora"])); // Format to 06:40 pm
                                        echo '<div class="showtime-selector">
                                                <a class="button-showtime-selector" href="../asientos.php?id_pelicula=' . $id_pelicula . '">' . $time . '</a>
                                              </div>';
                                    }
                                } else {
                                    echo "No showtimes available.";
                                }
                                ?>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>