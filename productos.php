<?php
include 'conexion.php';
session_start();

// Validar que haya cine elegido
if (!isset($_SESSION['compra']['cine'])) {
  die("No se ha elegido un cine.");
}
$id_cine = intval($_SESSION['compra']['cine']);

// Consulta: trae productos y la cantidad disponible para el cine
$query = "
  SELECT p.id_producto, p.nombre, p.precio, cp.cantidad
  FROM productos p
  JOIN cines_productos cp ON p.id_producto = cp.id_producto
  WHERE cp.id_cine = ?
";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_cine);
$stmt->execute();
$result = $stmt->get_result();

$productos = [];
while ($row = $result->fetch_assoc()) {
  $productos[] = $row;
}
?>

<?php
// 2️⃣ Mostrar estructura actual
echo '<h3>Estado actual de la compra:</h3>';
echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Elegir productos</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="css/movie.css">
  <link rel="stylesheet" href="css/producto.css">
  <style>
    .productos-lista {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }

    .producto-item {
      border: 1px solid #ddd;
      padding: 16px;
      border-radius: 8px;
      background: #fafafa;
    }

    .producto-item p {
      margin: 8px 0;
    }

    .button-product-form {
      margin-top: 20px;
      padding: 10px 20px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button-product-form:hover {
      background: #0056b3;
    }
  </style>
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
        <form class="product-form" method="POST" action="guardar_productos.php">
          <div class="productos-lista">
            <?php foreach ($productos as $index => $producto): ?>
              <div class="producto-item">
                <p><strong><?= htmlspecialchars($producto['nombre']) ?></strong></p>
                <p>Precio: S/ <?= number_format($producto['precio'], 2) ?></p>
                <p>Stock disponible: <?= intval($producto['cantidad']) ?></p>

                <input type="hidden" name="productos[<?= $index ?>][id_producto]" value="<?= intval($producto['id_producto']) ?>">
                <label>
                  Cantidad:
                  <input type="number" name="productos[<?= $index ?>][cantidad]" min="0" max="<?= intval($producto['cantidad']) ?>" value="0" step="1">
                </label>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="button-product-form" type="submit">Continuar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
