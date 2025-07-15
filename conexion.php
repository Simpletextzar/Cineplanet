<?php
    $mysqli = new mysqli("localhost", "root", "", "bd_cineplanet");

    if ($mysqli->connect_errno) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
?>
