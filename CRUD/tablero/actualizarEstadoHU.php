<?php
include '../../ConexionBD/conexion.php';

$idHU = $_POST['idHU'];
$nuevoEstado = $_POST['nuevoEstado'];

$actualizarEstado = "UPDATE hu_tablero SET estado = '$nuevoEstado' WHERE numeroHU = '$idHU'";
$resultado = $conexion->query($actualizarEstado);

if ($resultado) {
    $response = array("success" => true);
} else {
    $response = array("success" => false, "message" => "Error al actualizar el estado de la historia de usuario.");
}

echo json_encode($response);
?>
