<?php
include '../ConexionBD/conexion.php';

$valorPorHacer = $_POST['valorPorHacer'];
$valorHaciendo = $_POST['valorHaciendo'];
$valorTerminado = $_POST['valorTerminado'];
$nombreProyecto = $_POST['nombre'];
$numSprint = $_POST['SprintHU'];

$conexion -> query("INSERT INTO metricawip (valorPorHacer, valorHaciendo, valorTerminado, proyectoNombre , Sprint) 
VALUES ('$valorPorHacer', '$valorHaciendo', '$valorTerminado', '$nombreProyecto', '$numSprint')") or die($conexion -> error); 

if ($conexion) {
    Header("Location: ../WIP.php");
} else {
    echo "error";
}