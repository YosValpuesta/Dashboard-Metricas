<?php
                    //Recupero Numero de Sprints
$sprints = "SELECT NumSprint FROM proyecto";
$resultadoSprint = $conexion->query($sprints);
if ($resultadoSprint->num_rows > 0) {
    $fila = $resultadoSprint->fetch_assoc();
    $totalSprint = $fila["NumSprint"];
}
                    // Suponiendo que tienes el número total de sprints guardado en alguna variable
                    $totalSprints = 3; // Ajusta este valor según tu aplicación
                    // Consulta SQL para obtener las historias de usuario según el número de sprint
                    for ($sprint = 1; $sprint <= $totalSprints; $sprint++) {
                        $consulta = "SELECT * FROM hu WHERE Sprint = $sprint"; // Ajusta la consulta según tu estructura de base de datos

                        $resultado = $conexion->query($consulta);

                        if ($resultado->num_rows > 0) {
                            // Mostrar el collapser para este sprint
                            echo '<div class="accordion" id="accordionSprint' . $sprint . '">';
                            echo '<div class="card">';
                            echo '<div class="card-header" id="headingSprint' . $sprint . '">';
                            echo '<h2 class="mb-0">';
                            echo '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseSprint' . $sprint . '" aria-expanded="true" aria-controls="collapseSprint' . $sprint . '">';
                            echo 'Sprint ' . $sprint;
                            echo '</button>';
                            echo '</h2>';
                            echo '</div>';
                            echo '<div id="collapseSprint' . $sprint . '" class="collapse" aria-labelledby="headingSprint' . $sprint . '" data-parent="#accordionSprint' . $sprint . '">';
                            echo '<div class="card-body">';

                            // Mostrar las historias de usuario para este sprint
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "Número de HU: " . $fila["numeroHU"] . "<br>";
                                echo "Nombre: " . $fila["Nombre"] . "<br>";
                                echo "Descripción: " . $fila["Descripcion"] . "<br>";
                                echo "PH: " . $fila["PH"] . "<br>";
                                echo "Responsable: " . $fila["Responsable"] . "<br>";
                                echo "Estado: " . $fila["Estado"] . "<br>";
                                echo "<hr>";
                            }

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // Mostrar un mensaje si no hay historias de usuario para este sprint
                            echo '<div class="alert alert-warning" role="alert">';
                            echo 'No se encontraron historias de usuario para Sprint ' . $sprint;
                            echo '</div>';
                        }
                    }
                    ?>

<div class="col-sm-4" style="background-color: pink">
                                <br>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h5 class="card-title">Por hacer</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="card" id="tarjeta1" draggable="true">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>