<?php
include '../ConexionBD/conexion.php';
$nombreHU = $_POST['NombreHU'];
$descripcionHU = $_POST['DescripcionHU'];
$ph = $_POST['PH'];
$responsableHU = $_POST['ResponsableHU'];

$fecha_actual = date("d-m-Y");
$fecha = date("d-m-Y", strtotime($fecha_actual . " - 1 days"));
// $estadoHU = 'Por hacer';

$conexion -> query("INSERT INTO hu (Nombre, Descripcion, PH, Responsable, FechaCreacion, Estado) VALUES ('$nombreHU', '$descripcionHU', '$ph', '$responsableHU', '$fecha', 'Por hacer')") or die($conexion -> error); 

if ($conexion) {
    Header("Location: ../index.php");
} else {
    echo "error";
}