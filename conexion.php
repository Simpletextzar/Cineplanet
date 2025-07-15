<?php
    $mysqli = new mysqli("localhost", "root", "", "cine_real");

    if ($mysqli->connect_errno) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
?>
