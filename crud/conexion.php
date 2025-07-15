<?php
    $conexion = new mysqli("localhost", "root", "", "bd_cineplanet");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
?>
