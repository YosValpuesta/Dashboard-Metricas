<?php
    $servidor = "localhost";
    $nombreBD = "dashboard";
    $usuario = "root";
    $contraseña = "";

    $conexion = new mysqli($servidor, $usuario, $contraseña, $nombreBD);
    
    if ($conexion -> connect_error) {
        die("No se pudo conectar");
    }
?>