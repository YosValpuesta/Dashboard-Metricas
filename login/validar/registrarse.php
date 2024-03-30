<?php
include '../../ConexionBD/conexion.php';
session_start();

$correo = $_POST['Correo'];
$usuario = $_POST['Usuario'];
$contraseña = $_POST['Contraseña'];
$nombre = $_POST['Nombre'];
$apellidos = $_POST['Apellidos'];
$rol = $_POST['Rol'];
$cont = strlen($contraseña);

// Verificar si el correo o el usuario ya existen
$correo_query = "SELECT * FROM usuarios WHERE Correo='$correo'";
$usuario_query = "SELECT * FROM usuarios WHERE Usuario='$usuario'";

$correo_result = $conexion->query($correo_query);
$usuario_result = $conexion->query($usuario_query);

if ($correo_result->num_rows > 0) {
    session_start();
    $_SESSION['error'] = 'El correo ya existe';
    Header("Location: ../registroVista.php");
} elseif ($usuario_result->num_rows > 0) {
    session_start();
    $_SESSION['error'] = 'El usuario ya existe';
    Header("Location: ../registroVista.php");
} else {
    $insert_query = "INSERT INTO usuarios (Usuario, Nombre, Apellido, Correo, Contraseña, Rol) 
                    VALUES ('$usuario','$nombre','$apellidos','$correo','$contraseña','$rol')";

    if ($conexion->query($insert_query) === TRUE) {
        $_SESSION['Usuario'] = $usuario;
        session_start();
        $_SESSION['exito'] = 'Usuario creado con exito!';
        Header("Location: ../datosProyecto.php");
    } else {
        echo "<script>alert('Error al registrar el usuario: " . $conexion->error . "');</script>";
    }
}
