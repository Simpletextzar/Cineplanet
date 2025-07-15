<?php
include 'conexion.php'; // Asegúrate de incluir la conexión a la BD
session_start();

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);

// Validar formato básico de correo
if (!empty($nombre) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    // Verificar si el cliente existe en la tabla `clientes`
    $stmt = $mysqli->prepare("
        SELECT id_cliente 
        FROM clientes 
        WHERE nombre = ? AND email = ?
        LIMIT 1
    ");
    $stmt->bind_param("ss", $nombre, $correo);
    $stmt->execute();
    $stmt->bind_result($id_cliente);
    $stmt->fetch();
    $stmt->close();

    if ($id_cliente) {
        // Cliente encontrado: guardar su ID en la sesión
        $_SESSION['cliente'] = $id_cliente;

        // Redirigir a elegir_tipo_asiento.php
        header("Location: elegir_tipo_asiento.php");
        exit;
    } else {
        // Cliente NO registrado: mostrar mensaje y volver a login_cliente.php
        echo "<script>
            alert('Usuario no registrado. Por favor, verifica tus datos.');
            window.location.href = 'login_cliente.php';
        </script>";
        exit;
    }
} else {
    // Datos inválidos: formato incorrecto
    echo "<script>
        alert('Datos inválidos. Por favor, ingresa un nombre y un correo válidos.');
        window.location.href = 'login_cliente.php';
    </script>";
    exit;
}
?>
