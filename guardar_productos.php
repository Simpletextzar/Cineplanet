<?php
session_start();

// Limpiar productos previos
$_SESSION['compra']['productos'] = [];

// Guardar nuevos productos
if (isset($_POST['cantidad'])) {
  foreach ($_POST['cantidad'] as $nombre => $cantidad) {
    if ($cantidad > 0) {
      $_SESSION['compra']['productos'][] = [
        'nombre' => $nombre,
        'cantidad' => intval($cantidad)
      ];
    }
  }
}

// Redirigir a pago.php para mostrar opciones
header("Location: pago.php");
exit;
