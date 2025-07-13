<?php
session_start();

// Guarda asientos
$_SESSION['compra']['asientos'] = $_POST['asientos'] ?? [];

// Redirige con PRG
header("Location: elegir_tipo_asiento.php");
exit;
