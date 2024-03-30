<?php
include '../ConexionBD/conexion.php';
$nombreHU = $_POST['NombreHU'];
$descripcionHU = $_POST['DescripcionHU'];
$ph = $_POST['PH'];
$responsableHU = $_POST['ResponsableHU'];
$sprint = $_POST['SprintHU'];

$fecha_actual = date("d-m-Y");



$conexion -> query("INSERT INTO hu (Nombre, Descripcion, PH, Responsable, Sprint, FechaCreacion, Estado) VALUES ('$nombreHU', '$descripcionHU', '$ph', '$responsableHU', '$sprint', '$fecha_actual', 'Por hacer')") or die($conexion -> error); 

if ($conexion) {
    Header("Location: ../Backlog.php");
} else {
    echo "error";
}