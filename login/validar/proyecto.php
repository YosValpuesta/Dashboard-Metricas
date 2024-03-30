<?php
include '../../ConexionBD/conexion.php';

$nombreTablero = $_POST['NombreTablero'];
$sprintsTotal = $_POST['TotalSprints'];
$duracionSprint = $_POST['DuracionSprint'];
$duracion = $_POST['Duracion'];
$numDesarrolladores = $_POST['Desarrolladores'];
$fechaInicio = $_POST['FechaIni'];
$fechaFin = $_POST['FechaFin'];

$nombres = $_POST['Nombres'];
$apellidos = $_POST['Apellidos'];
$correos = $_POST['Correos'];
$usuarios = $_POST['Usuarios'];
$roles = $_POST['Roles'];

$tablero_query = "SELECT * FROM tablero WHERE Nombre='$nombreTablero'";
$tablero_result = $conexion->query($tablero_query);

if ($tablero_result->num_rows > 0) {
    session_start();
    $_SESSION['error'] = 'El nombre del tablero ya existe';
    Header("Location: ../datosProyecto.php");
} else {
    $conexion->begin_transaction();

    $conexion->query("INSERT INTO tablero (Nombre, TotalSprint, DuracionSprint, Duracion, Desarrolladores, FechaInicio, FechaFin) 
                        VALUES ('$nombreTablero','$sprintsTotal','$duracionSprint','$duracion','$numDesarrolladores','$fechaInicio','$fechaFin')") 
                        or die($conexion->error);

    $correosDuplicados = false;
    $usuariosDuplicados = false;

    for ($i = 0; $i < $numDesarrolladores; $i++) {
        $correo = $correos[$i];
        $usuario = $usuarios[$i];
        $rol = $roles[$i];

        $correo_query = "SELECT * FROM usuarios WHERE Correo='$correo'";
        $usuario_query = "SELECT * FROM usuarios WHERE Usuario='$usuario'";
        $correo_result = $conexion->query($correo_query);
        $usuario_result = $conexion->query($usuario_query);

        if ($correo_result->num_rows > 0) {
            $correosDuplicados = true;
            break;
        } elseif ($usuario_result->num_rows > 0) {
            $usuariosDuplicados = true;
            break;
        } else {
            $conexion->query("INSERT INTO usuarios (Usuario, Nombre, Apellido, Correo, Contraseña, Rol) 
                                VALUES ('$usuario','$nombres[$i]','$apellidos[$i]','$correo','uacm123','$rol')") 
                                or die($conexion->error);
        }
    }

    if ($correosDuplicados || $usuariosDuplicados) {
        $conexion->rollback();
        session_start();
        if ($correosDuplicados) {
            $_SESSION['error'] = 'Uno o más correos ya existen';
        } elseif ($usuariosDuplicados) {
            $_SESSION['error'] = 'Uno o más usuarios ya existen';
        }
        Header("Location: ../datosProyecto.php");
    } else {
        session_start();
        $_SESSION['exito'] = 'Tablero creado con éxito';
        Header("Location: ../../indexCuenta.php");
    }
}
?>