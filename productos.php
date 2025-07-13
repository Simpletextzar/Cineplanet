<?php
$mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");
// falta crear la siguiente pagina pago.php y luego boleta.php

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();
if (isset($_GET['id_pelicula'])) {
    $_SESSION['id_pelicula'] = $_GET['id_pelicula'];
}

// Handle product selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'])) {
    // productos is an array: [id_producto => cantidad]
    $_SESSION['productos'] = [];
    foreach ($_POST['productos'] as $id => $qty) {
        $qty = max(1, intval($qty));
        $_SESSION['productos'][$id] = $qty;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If no products selected, clear session
    $_SESSION['productos'] = [];
}

$productos = [];
$result = $mysqli->query("SELECT id_producto, nombre, precio FROM productos");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
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
    <link rel="stylesheet" href="css/producto.css">

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
                        <h1 class="title-container--title">Elegir productos</h1>
                    </div>
                    <form class="product-form" method="POST" action="pago.php">
                        <div class="productos-lista">
                            <?php foreach ($productos as $producto): ?>
                                <div class="producto-item">
                                    <label>
                                        <input type="checkbox" name="productos[<?= $producto['id_producto'] ?>]" value="0" style="margin-right:8px;">
                                        <?= htmlspecialchars($producto['nombre']) ?>
                                    </label>
                                    <p>Precio: S/ <?= number_format($producto['precio'], 2) ?></p>
                                    <input type="number" name="cantidad[<?= $producto['id_producto'] ?>]" value="0" min="0" step="1" style="width:50px;" <?= !isset($_POST['productos'][$producto['id_producto']]) ? 'disabled' : '' ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="button-product-form" type="submit">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Enable/disable quantity input based on checkbox
        document.querySelectorAll('input[type="checkbox"][name^="productos"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var qtyInput = document.querySelector('input[name="cantidad[' + this.name.match(/\d+/)[0] + ']"]');
                qtyInput.disabled = !this.checked;
            });
        });
    </script>

</body>
</html>