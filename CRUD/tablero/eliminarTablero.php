<?php
include '../../ConexionBD/conexion.php';
$id = $_REQUEST['numeroHU'];

$historiasUsuario = "DELETE FROM hu_tablero WHERE numeroHU = '$id'";
$resultado = $conexion->query($historiasUsuario);

if ($resultado) {
    // La eliminación se realizó correctamente
    $response = array("success" => true);
} else {
    // Error al eliminar la HU
    $response = array("success" => false, "message" => "Error al eliminar la historia de usuario.");
}
echo json_encode($response);

