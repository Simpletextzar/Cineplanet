<?php
session_start();

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);

// Validación básica (puedes añadir validación contra BD aquí si fuera necesario)
if (!empty($nombre) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    // Guardar los datos del cliente en sesión
    $_SESSION['cliente'] = [
        'nombre' => $nombre,
        'correo' => $correo
    ];

    // Redirigir a elegir_tipo_asiento.php
    header("Location: elegir_tipo_asiento.php");
    exit;
} else {
    // Si falla, mostrar alerta y regresar a login_cliente.php
    echo "<script>
        alert('Datos inválidos. Por favor, ingresa un nombre y un correo válidos.');
        window.location.href = 'login_cliente.php';
    </script>";
    exit;
}
