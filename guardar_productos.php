<?php
session_start();

// Limpiar productos previos
$_SESSION['compra']['productos'] = [];

// Verificar que lleguen productos como array de arrays
if (isset($_POST['productos']) && is_array($_POST['productos'])) {
  foreach ($_POST['productos'] as $producto) {
    // Validar estructura
    if (
      isset($producto['id_producto']) &&
      isset($producto['cantidad'])
    ) {
      $id_producto = intval($producto['id_producto']);
      $cantidad = intval($producto['cantidad']);

      if ($cantidad > 0) {
        $_SESSION['compra']['productos'][] = [
          'id_producto' => $id_producto,
          'cantidad' => $cantidad
        ];
      }
    }
  }
}

// Redirigir a pago.php
header("Location: pago.php");
exit;
