<?php
include 'conexion.php';
session_start();

$_SESSION['compra']['productos'] = []; 

if (isset($_POST['productos'])) {
  foreach ($_POST['productos'] as $id_producto => $cantidad) {
    $cantidad = intval($cantidad);
    if ($cantidad > 0) {
      // 🔍 Obtener precio unitario
      $stmt = $mysqli->prepare("SELECT precio FROM productos WHERE id_producto = ?");
      $stmt->bind_param("i", $id_producto);
      $stmt->execute();
      $stmt->bind_result($precio_unitario);
      $stmt->fetch();
      $stmt->close();

      $_SESSION['compra']['productos'][] = [
        'id_producto' => $id_producto,
        'cantidad'    => $cantidad,
        'precio'      => $precio_unitario
      ];
    }
  }
}

header("Location: pago.php");
exit;
?>