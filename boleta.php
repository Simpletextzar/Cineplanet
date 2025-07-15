<?php
include 'conexion.php';
session_start();

// Obtén los datos base
$id_cliente  = $_SESSION['compra']['cliente'];
$id_cine     = $_SESSION['compra']['cine'];
$metodo_pago = $_SESSION['compra']['metodo_pago'];

// Determina si hay boletos o productos
$tiene_boletos   = !empty($_SESSION['compra']['asientos']);
$tiene_productos = !empty($_SESSION['compra']['productos']);

// Guardar ID de venta para cada tipo
$id_venta_boleto   = null;
$id_venta_producto = null;

// ---------------------------------
// Insertar en ventas_boletos (si aplica)
if ($tiene_boletos) {
  $stmt = $mysqli->prepare("
    INSERT INTO ventas_boletos (id_cliente, id_cine, fecha_venta, total, metodo_pago)
    VALUES (?, ?, NOW(), NULL, ?)
  ");
  if (!$stmt) {
    die("Error prepare ventas_boletos: " . $mysqli->error);
  }

  $stmt->bind_param("iis", $id_cliente, $id_cine, $metodo_pago);
  if ($stmt->execute()) {
    $id_venta_boleto = $mysqli->insert_id;
    $_SESSION['compra']['id_venta_boleto'] = $id_venta_boleto;
    echo "✅ Venta de boletos registrada: $id_venta_boleto <br>";
  } else {
    echo "❌ Error insertar ventas_boletos: " . $stmt->error;
  }
  $stmt->close();
}

// ---------------------------------
// Insertar en ventas_productos (si aplica)
if ($tiene_productos) {
  // Buscar primer empleado del cine
  $stmt = $mysqli->prepare("SELECT id_empleado FROM empleados WHERE id_cine = ? LIMIT 1");
  $stmt->bind_param("i", $id_cine);
  $stmt->execute();
  $stmt->bind_result($id_empleado);
  $stmt->fetch();
  $stmt->close();

  if (!$id_empleado) {
    die("❌ No se encontró empleado para ventas_productos.");
  }

  $stmt = $mysqli->prepare("
    INSERT INTO ventas_productos (id_cliente, id_empleado, id_cine, fecha_venta, total, metodo_pago)
    VALUES (?, ?, ?, NOW(), NULL, ?)
  ");
  if (!$stmt) {
    die("Error prepare ventas_productos: " . $mysqli->error);
  }

  $stmt->bind_param("iiis", $id_cliente, $id_empleado, $id_cine, $metodo_pago);
  if ($stmt->execute()) {
    $id_venta_producto = $mysqli->insert_id;
    $_SESSION['compra']['id_venta_producto'] = $id_venta_producto;
    echo "✅ Venta de productos registrada: $id_venta_producto <br>";
  } else {
    echo "❌ Error insertar ventas_productos: " . $stmt->error;
  }
  $stmt->close();
}

// ---------------------------------
echo "<p>Ventas registradas correctamente.</p>";
?>
