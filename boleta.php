<?php
session_start();

echo '<h2>Resumen Final de Compra:</h2>';
echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';


$compra = $_SESSION['compra'] ?? null;

if (!$compra) {
  echo "<h2>No hay datos de compra.</h2>";
  exit;
}

echo "<h1>🎟️ Tu Boleta de Compra</h1>";

echo "<h3>🎬 Película:</h3>";
echo "<p>ID Película: " . htmlspecialchars($compra['pelicula'] ?? '---') . "</p>";

echo "<h3>🎟️ Función:</h3>";
echo "<p>ID Función: " . htmlspecialchars($compra['funcion'] ?? '---') . "</p>";

echo "<h3>📍 Cine:</h3>";
echo "<p>ID Cine: " . htmlspecialchars($compra['cine'] ?? '---') . "</p>";

echo "<h3>🌍 Ciudad:</h3>";
echo "<p>ID Ciudad: " . htmlspecialchars($compra['ciudad'] ?? '---') . "</p>";

echo "<h3>💺 Asientos:</h3>";
if (!empty($compra['asientos'])) {
  echo "<ul>";
  foreach ($compra['asientos'] as $asiento) {
    echo "<li>" . htmlspecialchars($asiento) . "</li>";
  }
  echo "</ul>";
} else {
  echo "<p>No seleccionaste asientos.</p>";
}

echo "<h3>🎫 Tipos de boletos:</h3>";

$tipos_validos = false; // bandera para saber si hay alguno > 0

if (!empty($compra['tipos_boletos'])) {
  echo "<ul>";
  foreach ($compra['tipos_boletos'] as $tipo => $cantidad) {
    if (intval($cantidad) > 0) {
      echo "<li>$tipo: " . intval($cantidad) . "</li>";
      $tipos_validos = true;
    }
  }
  echo "</ul>";

  if (!$tipos_validos) {
    echo "<p>No hay tipos de boletos seleccionados.</p>";
  }

} else {
  echo "<p>No hay tipos de boletos.</p>";
}

echo "<h3>🍿 Productos:</h3>";
if (!empty($compra['productos'])) {
  echo "<ul>";
  foreach ($compra['productos'] as $producto) {
    echo "<li>" . htmlspecialchars($producto['id_producto']) . ": " . intval($producto['cantidad']) . "</li>";
  }
  echo "</ul>";
} else {
  echo "<p>No elegiste productos.</p>";
}

echo "<h3>💳 Método de pago:</h3>";
echo "<p>" . htmlspecialchars($compra['metodo_pago'] ?? 'No especificado') . "</p>";
