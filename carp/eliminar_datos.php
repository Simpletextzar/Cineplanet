<?php
include 'conexion.php'; // Asegúrate que este archivo crea $conexion con mysqli o PDO

$tabla = $_POST['tabla'] ?? null;
$id = $_POST['id'] ?? null;

if (!$tabla || !$id) {
    die("Error: Faltan datos obligatorios.");
}

// Mapeo de campos ID por tabla
$campos_id = [
    'clientes' => 'id_cliente',
    'peliculas' => 'id_pelicula',
    'productos' => 'id_producto',
    'empleados' => 'id_empleado',
    'ventas' => 'id_venta',
    'funciones' => 'id_funcion',
    // Agrega más tablas si lo deseas
];

// Validación de seguridad
if (!array_key_exists($tabla, $campos_id)) {
    die("Error: Tabla no permitida.");
}

$campo_id = $campos_id[$tabla];

// Preparar y ejecutar la eliminación
try {
    $stmt = $conexion->prepare("DELETE FROM `$tabla` WHERE `$campo_id` = ?");
    $stmt->bind_param("i", $id); // asume que el ID es numérico entero

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "No se encontró ningún registro con ese ID.";
        }
    } else {
        echo "Error al ejecutar la eliminación: " . $stmt->error;
    }

    $stmt->close();
} catch (Exception $e) {
    echo "Excepcion: " . $e->getMessage();
}
?>
