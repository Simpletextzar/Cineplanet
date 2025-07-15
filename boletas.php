<?php
include 'conexion.php';
session_start();

echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';


// ====================
// VARIABLES GLOBALES
// ====================
$id_cliente        = $_SESSION['compra']['cliente'];
$id_venta_boleto   = $_SESSION['compra']['id_venta_boleto'];
$id_venta_producto = $_SESSION['compra']['id_venta_producto'] ?? null; // puede no existir
$id_funcion        = $_SESSION['compra']['funcion'];
$asientos          = $_SESSION['compra']['asientos'];
$tipos_boletos     = $_SESSION['compra']['tipos_boletos'];
$productos         = $_SESSION['compra']['productos'] ?? []; // puede no existir

// ====================
// CLIENTE
// ====================
$stmt = $mysqli->prepare("
  SELECT nombre, apellido 
  FROM clientes 
  WHERE id_cliente = ?
");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$stmt->bind_result($nombre_cliente, $apellido_cliente);
$stmt->fetch();
$stmt->close();

// ====================
// PELÍCULA
// ====================
$stmt = $mysqli->prepare("
  SELECT p.nombre 
  FROM peliculas p
  JOIN funciones f ON p.id_pelicula = f.id_pelicula
  WHERE f.id_funcion = ?
");
$stmt->bind_param("i", $id_funcion);
$stmt->execute();
$stmt->bind_result($titulo_pelicula);
$stmt->fetch();
$stmt->close();

// ====================
// FUNCIÓN
// ====================
$stmt = $mysqli->prepare("
  SELECT fecha, hora, id_sala_cine 
  FROM funciones 
  WHERE id_funcion = ?
");
$stmt->bind_param("i", $id_funcion);
$stmt->execute();
$stmt->bind_result($fecha_funcion, $hora_funcion, $id_sala_cine);
$stmt->fetch();
$stmt->close();

// ====================
// SALA
// ====================
$stmt = $mysqli->prepare("
  SELECT num_sala 
  FROM salas_cine 
  WHERE id_sala_cine = ?
");
$stmt->bind_param("i", $id_sala_cine);
$stmt->execute();
$stmt->bind_result($num_sala);
$stmt->fetch();
$stmt->close();

// ====================
// ASIENTOS DETALLES
// ====================
$asientos_detalles = [];
foreach ($asientos as $id_asiento) {
  $stmt = $mysqli->prepare("
    SELECT fila, columna 
    FROM asientos 
    WHERE id_asiento = ?
  ");
  $stmt->bind_param("i", $id_asiento);
  $stmt->execute();
  $stmt->bind_result($fila, $columna);
  $stmt->fetch();
  $asientos_detalles[] = ['fila' => $fila, 'columna' => $columna];
  $stmt->close();
}

// ====================
// TOTAL BOLETOS
// ====================
$stmt = $mysqli->prepare("
  SELECT total 
  FROM ventas_boletos 
  WHERE id_venta_boleto = ?
");
$stmt->bind_param("i", $id_venta_boleto);
$stmt->execute();
$stmt->bind_result($total_boletos);
$stmt->fetch();
$stmt->close();

// ====================
// TOTAL PRODUCTOS (solo si hay productos)
// ====================
if (!empty($productos) && $id_venta_producto) {
  $stmt = $mysqli->prepare("
    SELECT total 
    FROM ventas_productos 
    WHERE id_venta_producto = ?
  ");
  $stmt->bind_param("i", $id_venta_producto);
  $stmt->execute();
  $stmt->bind_result($total_productos);
  $stmt->fetch();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Boletas</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    h1 { color: #333; margin-top: 40px; }
    table { border-collapse: collapse; width: 70%; margin-top: 20px; }
    table, th, td { border: 1px solid #999; }
    th, td { padding: 8px; text-align: left; }
    .total { font-weight: bold; }
    hr { margin: 50px 0; border: 2px solid #ccc; }
  </style>
</head>
<body>

  <!-- ==================== -->
  <!-- BOLETA DE BOLETOS -->
  <!-- ==================== -->
  <h1>🎟️ Boleta de Boletos</h1>

  <p><strong>ID Venta Boleto:</strong> <?= htmlspecialchars($id_venta_boleto) ?></p>
  <p><strong>Cliente:</strong> <?= htmlspecialchars($nombre_cliente) . " " . htmlspecialchars($apellido_cliente) ?></p>
  <p><strong>Película:</strong> <?= htmlspecialchars($titulo_pelicula) ?></p>
  <p><strong>Fecha:</strong> <?= htmlspecialchars($fecha_funcion) ?></p>
  <p><strong>Hora:</strong> <?= htmlspecialchars($hora_funcion) ?></p>
  <p><strong>Sala:</strong> <?= htmlspecialchars($num_sala) ?></p>

  <h3>Asientos seleccionados</h3>
  <table>
    <tr>
      <th>Fila</th>
      <th>Columna</th>
    </tr>
    <?php foreach ($asientos_detalles as $a): ?>
    <tr>
      <td><?= htmlspecialchars($a['fila']) ?></td>
      <td><?= htmlspecialchars($a['columna']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

  <p><strong>Total Asientos:</strong> <?= count($asientos_detalles) ?></p>

  <h3>Tipos de entradas</h3>
  <table>
    <tr>
      <th>Tipo</th>
      <th>Cantidad</th>
      <th>Precio Unitario</th>
      <th>Subtotal</th>
    </tr>
    <?php
      foreach ($tipos_boletos as $tipo => $info) {
        $cantidad = $info['cantidad'];
        $precio_unitario = $info['precio_unitario'];
        $subtotal = $cantidad * $precio_unitario;
        echo "<tr>
          <td>$tipo</td>
          <td>$cantidad</td>
          <td>S/ " . number_format($precio_unitario, 2) . "</td>
          <td>S/ " . number_format($subtotal, 2) . "</td>
        </tr>";
      }
    ?>
    <tr>
      <td colspan="3" class="total">TOTAL</td>
      <td class="total">S/ <?= number_format($total_boletos, 2) ?></td>
    </tr>
  </table>

  <!-- ==================== -->
  <!-- BOLETA DE PRODUCTOS -->
  <!-- ==================== -->
  <?php if (!empty($productos) && $id_venta_producto): ?>
    <hr>

    <h1>🧃 Boleta de Productos</h1>

    <p><strong>ID Venta Productos:</strong> <?= htmlspecialchars($id_venta_producto) ?></p>
    <p><strong>Cliente:</strong> <?= htmlspecialchars($nombre_cliente) . " " . htmlspecialchars($apellido_cliente) ?></p>

    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos as $prod): ?>
          <?php
            $id_producto = intval($prod['id_producto']);
            $stmt = $mysqli->prepare("SELECT nombre FROM productos WHERE id_producto = ?");
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $stmt->bind_result($nombre_producto);
            $stmt->fetch();
            $stmt->close();
            $cantidad = intval($prod['cantidad']);
            $precio_unitario = floatval($prod['precio']);
            $subtotal = $cantidad * $precio_unitario;
          ?>
          <tr>
            <td><?= $nombre_producto ?></td>
            <td><?= $cantidad ?></td>
            <td>S/ <?= number_format($precio_unitario, 2) ?></td>
            <td>S/ <?= number_format($subtotal, 2) ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3" class="total">TOTAL</td>
          <td class="total">S/ <?= number_format($total_productos, 2) ?></td>
        </tr>
      </tbody>
    </table>
  <?php endif; ?>
    <br><br>
  <form action="index.html" method="get">
    <button type="submit" style="
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      color: white;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    ">
      Ir al Inicio
    </button>
  </form>
</body>
</html>
