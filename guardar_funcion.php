<?php
session_start();

// ✅ Solo si no existe todavía:
if (!isset($_SESSION['compra'])) {
  $_SESSION['compra'] = [
    'pelicula' => null,
    'cliente' => null,
    'cine' => null,
    'funcion' => null,
    'ciudad' => null,
    'asientos' => [],
    'tipos_boletos' => [],
    'productos' => [],
    'metodo_pago' => null 
  ];
}

// Luego actualizas con lo recibido:
$_SESSION['compra']['pelicula'] = $_POST['id_pelicula'] ?? null;
$_SESSION['compra']['ciudad']   = $_POST['id_ciudad'] ?? null;
$_SESSION['compra']['cine']     = $_POST['id_cine'] ?? null;
$_SESSION['compra']['funcion']  = $_POST['id_funcion'] ?? null;

header("Location: asientos.php");
exit;
