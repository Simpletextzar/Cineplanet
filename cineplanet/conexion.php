<?php
    $mysqli = new mysqli("localhost", "root", "", "cineplanet_bd");

    if ($mysqli->connect_errno) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
?>
