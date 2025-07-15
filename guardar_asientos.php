<?php
session_start();
include 'conexion.php';

// Validar asientos recibidos
if (!isset($_POST['asientos']) || !is_array($_POST['asientos']) || empty($_POST['asientos'])) {
  header("Location: elegir_asientos.php");
  exit;
}

// Tomar asientos nuevos
$asientos_nuevos = $_POST['asientos'];

// Marcar como ocupados (estado 2)
foreach ($asientos_nuevos as $id_asiento) {
  $sql = "UPDATE asientos SET id_estado = 2 WHERE id_asiento = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $id_asiento);
  $stmt->execute();
  $stmt->close();
}

// Guardar en sesión
$_SESSION['compra']['asientos'] = $asientos_nuevos;

// Redirigir al siguiente paso
header("Location: login_cliente.php");
exit;
