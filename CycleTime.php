<?php
include 'ConexionBD/conexion.php';
session_start();

// Realiza la consulta SQL para obtener los datos necesarios
$consultaHU = $conexion->query("SELECT numeroHU, fechaAgregada, fechaIniciada, fechaTerminada FROM hu_tablero WHERE Sprint = '1'") or die($conexion->error);

// Array para almacenar los Lead Time de cada HU
$cycleTimes = array();

// Itera sobre los resultados de la consulta y calcula el Lead Time de cada HU
while ($hu = $consultaHU->fetch_assoc()) {
    // Convierte las fechas de texto a objetos DateTime para cálculos
    $fechaAgregada = new DateTime($hu['fechaAgregada']);
    $fechaIniciada = new DateTime($hu['fechaIniciada']);
    $fechaTerminada = new DateTime($hu['fechaTerminada']);

    // Calcula el tiempo transcurrido en días entre las fechas
    $cycleTime = $fechaTerminada->diff($fechaIniciada)->days;

    // Almacena el Lead Time en el array asociativo usando el número de HU como clave
    $cycleTimes[$hu['numeroHU']] = $cycleTime;
}

// Ahora $leadTimes contiene los Lead Time de cada HU
echo json_encode($cycleTimes); // Imprime los datos en formato JSON para ser utilizados por JavaScript
?>



<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Métrica WIP</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">
    <?php include 'alertas.php' ?>
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <h1 class="text-center">Métrica CycleTime</h1>
                <br>
                <div class="container" style="width: 80%; height: 80%;">
                    <div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <canvas id="leadTimeChart" width="400" height="200" style="background-color: #c4dfe4;"></canvas>
                    </div>


                    <script>
                        const ctx = document.getElementById('leadTimeChart').getContext('2d');

                        // Obtener los datos de Lead Time y números de HU desde PHP e imprimirlos en el script de Chart.js
                        const leadTimesData = <?php echo json_encode($cycleTimes); ?>;
                        const numerosHU = <?php echo json_encode(array_keys($cycleTimes)); ?>; // Array de números de HU

                        const labels = numerosHU.map(numero => 'HU ' + numero); // Etiquetas basadas en el número de HU

                        // Calcular el promedio de la suma de los días de Lead Time de todas las HUs
                        const leadTimesArray = Object.values(leadTimesData);
                        const leadTimesSum = leadTimesArray.reduce((acc, curr) => acc + curr, 0);
                        const leadTimesAverage = leadTimesSum / leadTimesArray.length;

                        // Crear un array con el promedio para cada HU
                        const leadTimesAverageArray = Array.from({
                            length: leadTimesArray.length
                        }, () => leadTimesAverage);

                        const data = {
                            labels: labels,
                            datasets: [{
                                label: 'Lead Time de HU',
                                data: leadTimesArray, // Utiliza los Lead Time obtenidos desde PHP
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de fondo del gráfico
                                tension: 0.1
                            }, {
                                label: 'Promedio de Lead Time',
                                data: leadTimesAverageArray, // Utiliza el array de promedio
                                fill: false,
                                borderColor: 'rgb(255, 99, 132)', // Color de la línea de promedio
                                borderDash: [5, 5], // Estilo de línea de puntos para el promedio
                                tension: 0.1
                            }]
                        };

                        const leadTimeChart = new Chart(ctx, {
                            type: 'line',
                            data: data,
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Número de HU'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Días de Lead Time de HU'
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const dataIndex = context.dataIndex;
                                                const numeroHU = numerosHU[dataIndex];
                                                return 'HU ' + numeroHU + ': ' + context.parsed.y + ' días'; // Muestra el número de HU en la etiqueta
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>


                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>