<?php
include 'conexion.php';
session_start();

// Datos base del session
$id_cliente  = $_SESSION['compra']['cliente'];
$id_cine     = $_SESSION['compra']['cine'];
$metodo_pago = $_SESSION['compra']['metodo_pago'];

$tiene_boletos   = !empty($_SESSION['compra']['asientos']);
$tiene_productos = !empty($_SESSION['compra']['productos']);

$id_venta_boleto   = null;
$id_venta_producto = null;

// --------------------
// Insertar ventas_boletos (si aplica)
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
    echo "Venta de boletos registrada: $id_venta_boleto <br>";
  } else {
    echo "Error insertar ventas_boletos: " . $stmt->error;
  }
  $stmt->close();
}

// --------------------
// Insertar ventas_productos (si aplica)
if ($tiene_productos) {
  // Buscar primer empleado del cine con rol = 1
  $stmt = $mysqli->prepare("
    SELECT id_empleado FROM empleados 
    WHERE id_empleado = 9999 AND id_rol = 1 
    LIMIT 1
  ");
  if (!$stmt) {
    die("Error prepare SELECT empleado: " . $mysqli->error);
  }

  $stmt->execute();
  $stmt->bind_result($id_empleado);
  $stmt->fetch();
  $stmt->close();

  if (!$id_empleado) {
    die("No se encontró empleado con id_rol = 1 para ventas_productos.");
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
    echo "Venta de productos registrada: $id_venta_producto <br>";
  } else {
    echo "Error insertar ventas_productos: " . $stmt->error;
  }
  $stmt->close();
}

echo "<p>Registro de ventas completado.</p>";
?>

<?php
$id_funcion = $_SESSION['compra']['funcion'];

// 1. Obtener precio base de la función
$stmtPrecio = $mysqli->prepare("SELECT precio FROM funciones WHERE id_funcion = ?");
$stmtPrecio->bind_param("i", $id_funcion);
$stmtPrecio->execute();
$stmtPrecio->bind_result($precio_base);
$stmtPrecio->fetch();
$stmtPrecio->close();

// 2. Datos base
$tipos_boletos = $_SESSION['compra']['tipos_boletos'];
$asientos = $_SESSION['compra']['asientos'];

$detalle_boletos = [];
$tipos_boletos_actualizados = []; // Inicializa el acumulador correcto

$asiento_index = 0;

// 3. Generar detalle de asientos por tipo y acumular cantidad/precio
foreach ($tipos_boletos as $tipo => $cantidad) {

  // Calcular precio unitario para este tipo
  switch ($tipo) {
    case 'General':
      $precio_final = $precio_base;
      break;
    case 'Niño':
      $precio_final = $precio_base * 0.5;
      break;
    case 'Adulto Mayor':
      $precio_final = $precio_base * 0.6;
      break;
  }

  // Guarda cantidad y precio unitario una sola vez por tipo
  $tipos_boletos_actualizados[$tipo] = [
    'cantidad' => $cantidad,
    'precio_unitario' => $precio_final
  ];

  // Generar detalles de asiento por cada cantidad
  for ($i = 0; $i < $cantidad; $i++) {
    if (!isset($asientos[$asiento_index])) {
      die("Error: Faltan asientos para la cantidad de tipos de boletos.");
    }

    $detalle_boletos[] = [
      'id_asiento' => $asientos[$asiento_index],
      'tipo' => $tipo,
      'precio' => $precio_final
    ];

    $asiento_index++;
  }
}

$id_venta_boleto = $_SESSION['compra']['id_venta_boleto'];

// 4. Insertar todos los detalles_boletos
foreach ($detalle_boletos as $detalle) {
  $id_asiento = $detalle['id_asiento'];
  $tipo = $detalle['tipo'];
  $precio_final = $detalle['precio'];

  $stmt = $mysqli->prepare("
    INSERT INTO detalles_boletos 
    (id_funcion, id_asiento, tipo, precio, id_venta_boleto)
    VALUES (?, ?, ?, ?, ?)
  ");
  $stmt->bind_param("iisdi", $id_funcion, $id_asiento, $tipo, $precio_final, $id_venta_boleto);
  $stmt->execute();
  $stmt->close();
}

// 5. Guardar estructura final en session para usarla en boleta
$_SESSION['compra']['tipos_boletos'] = $tipos_boletos_actualizados;

// 6. Actualizar total de la venta
$mysqli->query("
  UPDATE ventas_boletos 
  SET total = (SELECT SUM(precio) FROM detalles_boletos WHERE id_venta_boleto = $id_venta_boleto)
  WHERE id_venta_boleto = $id_venta_boleto
");
?>


<?php
$id_venta_producto = $_SESSION['compra']['id_venta_producto'];
$productos = $_SESSION['compra']['productos'];

foreach ($productos as $p) {
  $id_producto = intval($p['id_producto']);
  $cantidad = intval($p['cantidad']);
  $precio_unitario = floatval($p['precio']);

  $subtotal = $precio_unitario * $cantidad;

  $stmt = $mysqli->prepare("
    INSERT INTO detalles_productos 
    (id_producto, cantidad, precio_unitario, subtotal, id_venta_producto)
    VALUES (?, ?, ?, ?, ?)
  ");
  $stmt->bind_param("iiddi", $id_producto, $cantidad, $precio_unitario, $subtotal, $id_venta_producto);
  $stmt->execute();
  $stmt->close();
}


// Actualizar total en ventas_productos
$mysqli->query("
  UPDATE ventas_productos
  SET total = (SELECT SUM(subtotal) FROM detalles_productos WHERE id_venta_producto = $id_venta_producto)
  WHERE id_venta_producto = $id_venta_producto
");

// Redirigir a boletas.php
header("Location: boletas.php");
exit;
?>