<?php
    include 'conexion.php';

    $tabla = $_POST['tabla'];
    unset($_POST['tabla']);

    $columnas = array_keys($_POST);
    $valores = array_map(function($valor) use ($conexion) {
    if (is_numeric($valor)) {
        return $conexion->real_escape_string($valor);
    } else {
        return "'" . $conexion->real_escape_string($valor) . "'";
    }
    }, array_values($_POST));

    $sql = "INSERT INTO $tabla (" . implode(",", $columnas) . ") VALUES (" . implode(",", $valores) . ")";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro insertado correctamente en $tabla.";
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();

    
    header("Location: listar_tabla.php?tabla=$tabla");
    exit;
?>
