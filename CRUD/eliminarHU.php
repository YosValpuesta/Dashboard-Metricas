<?php
    include '../ConexionBD/conexion.php';
    $id = $_REQUEST['id'];

    $historiasUsuario = "DELETE FROM hu WHERE numeroHU = '$id'";
    $resultado = $conexion->query($historiasUsuario);

    if ($resultado) { 
        Header("Location: ../Backlog.php");
    } else {
        echo "error";
    }
?>