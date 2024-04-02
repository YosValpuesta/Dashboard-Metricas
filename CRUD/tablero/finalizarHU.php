<?php
include '../../ConexionBD/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numeroHU'])) {
    $numeroHU = $_POST['numeroHU'];
    $estado = 'Terminada';

    $cantidadTerminada = $conexion->query("SELECT COUNT(*) AS total FROM hu_tablero WHERE estado = 'Terminada'")->fetch_assoc()['total'];

    // Obtener el límite de "Terminada"
    $resultado = $conexion->query("SELECT valorTerminado FROM metricawip") or die($conexion->error);
    $valorTerminado = mysqli_fetch_array($resultado);
    $TerminadoWIP = $valorTerminado['valorTerminado'];

    // Verificar si se ha superado el límite de "Terminada" al mover una HU
    if ($cantidadTerminada >= $TerminadoWIP) {
        $_SESSION['error'] = 'Se ha alcanzado el límite de elementos en estado "Terminado". No se puede agregar más HUs terminadas.';
        echo json_encode(['success' => false, 'message' => $_SESSION['error']]);
        exit();
    }

    $conexion->query("UPDATE hu_tablero SET estado = '$estado' WHERE numeroHU = '$numeroHU'") or die($conexion->error);

    // Devolver una respuesta JSON indicando el éxito de la actualización
    echo json_encode(['success' => true]);
} else {
    // Si no se reciben datos adecuados, devolver un error
    echo json_encode(['success' => false, 'message' => 'Datos incorrectos']);
}
?>
