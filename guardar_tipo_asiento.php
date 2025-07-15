<?php
session_start();

// Guarda los tipos de boletos
$_SESSION['compra']['tipos_boletos'] = $_POST['tipos_boletos'] ?? [];

// Redirige al siguiente paso
header("Location: productos.php");
exit;
