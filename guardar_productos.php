<?php
include 'conexion.php';
session_start();

$_SESSION['compra']['productos'] = []; 

if (isset($_POST['productos'])) {
  foreach ($_POST['productos'] as $producto) {
    $id_producto = intval($producto['id_producto']);
    $cantidad = intval($producto['cantidad']);

    if ($cantidad > 0) {
      $stmt = $mysqli->prepare("SELECT precio FROM productos WHERE id_producto = ?");
      $stmt->bind_param("i", $id_producto);
      $stmt->execute();
      $stmt->bind_result($precio_unitario);
      if ($stmt->fetch()) {
        $_SESSION['compra']['productos'][] = [
          'id_producto' => $id_producto,
          'cantidad'    => $cantidad,
          'precio'      => $precio_unitario
        ];
      }
      $stmt->close();
    }
  }
}

header("Location: pago.php");
exit;
?>