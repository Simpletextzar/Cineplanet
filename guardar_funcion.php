<?php
session_start();

$_SESSION['compra'] = [
  'pelicula' => $_POST['id_pelicula'] ?? null,
  'cliente' => null,
  'cine' => $_POST['id_cine'] ?? null,
  'funcion' => $_POST['id_funcion'] ?? null,
  'ciudad' => $_POST['id_ciudad'] ?? null,
  'asientos' => [],
  'tipos_boletos' => [],
  'productos' => [],
  'metodo_pago' => null,
  'id_venta_boleto' => null,
  'id_venta_producto' => null 
];

header("Location: asientos.php");
exit;
