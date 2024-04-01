<?php
include '../ConexionBD/conexion.php';

// Verificar si se reciben los datos necesarios por POST
if (isset($_POST['idHU'], $_POST['nuevoEstado'])) {
    // Obtener los datos y sanitizarlos
    $idHU = mysqli_real_escape_string($conexion, $_POST['idHU']);
    $nuevoEstado = mysqli_real_escape_string($conexion, $_POST['nuevoEstado']);

    // Actualizar el estado en la base de datos
    $queryUpdate = "UPDATE hu_tablero SET estado = '$nuevoEstado' WHERE numeroHU = $idHU";
    echo 'Consulta SQL: ' . $queryUpdate;
    $resultado = $conexion->query($queryUpdate);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        echo 'Estado actualizado correctamente';
    } else {
        echo 'Error al actualizar el estado';
    }
} else {
    echo 'No se recibieron los datos necesarios para actualizar el estado';
}
?>
