<?php
include '../../ConexionBD/conexion.php';
session_start();

if (isset($_POST['Usuario']) && isset($_POST['Contraseña'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validate($_POST['Usuario']);
    $contraseña = validate($_POST['Contraseña']);

    $Sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario' AND Contraseña = '$contraseña' ";
    $resultado = mysqli_query($conexion, $Sql);
    if (mysqli_num_rows($resultado) === 1) {
        $row = mysqli_fetch_assoc($resultado);
        if ($row['Usuario'] === $usuario && $row['Contraseña'] === $contraseña) {
            $_SESSION['Usuario'] = $usuario;
            session_start();
            $_SESSION['inicioSesion'] = $usuario;
            header("Location: ../../indexCuenta.php");
            exit();
        } else {
            header("Location: ../loginVista.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION['inicioDenegado'] = 'Contraseña ó Usuario incorrecto';
        header("Location: ../loginVista.php");
    }
}
