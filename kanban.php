<?php
session_start();
include 'ConexionBD/conexion.php';
if (isset($_GET['numeroHU'])) {
    $numeroHU = $_GET['numeroHU'];
    $consulta = "SELECT * FROM hu WHERE numeroHU = $numeroHU";
    $resultado = $conexion->query($consulta);
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/kanban.css">
    <script src="drag.js" defer></script>
    <title>CorsolaCorp: Tablero kanban</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid">
                    <div class="board">
                        <div class="lanes">
                            <div class="swim-lane" id="todo-lane">
                                <h3 class="heading">Por hacer</h3>
                                <p class="task" draggable="true">HU1</p>
                                <p class="task" draggable="true">HU2</p>
                                <p class="task" draggable="true">HU3</p>
                            </div>

                            <div class="swim-lane">
                                <h3 class="heading">Haciendo</h3>
                                <p class="task" draggable="true">HU4</p>
                            </div>

                            <div class="swim-lane">
                                <h3 class="heading">Hecho</h3>
                                <p class="task" draggable="true">HU5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // mostrar HU añadida
            // if ($resultado->num_rows > 0) {
            //     // Mostrar los datos de la HU
            //     $fila = $resultado->fetch_assoc();
            //     echo "Número de HU: " . $fila["numeroHU"] . "<br>";
            //     echo "Nombre: " . $fila["Nombre"] . "<br>";
            //     echo "Descripción: " . $fila["Descripcion"] . "<br>";
            //     echo "PH: " . $fila["PH"] . "<br>";
            //     echo "Responsable: " . $fila["Responsable"] . "<br>";
            //     echo "Estado: " . $fila["Estado"] . "<br>";
            // } else {
            //     // Mostrar un mensaje si no se encuentra la HU
            //     echo "No se encontraron datos para la HU con número " . $numeroHU;
            // } 
            ?>
        </div>


    </div>


    <!-- Agrega la biblioteca jQuery y jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

    <!-- Agrega el script para manejar el arrastre y suelte de las tarjetas -->
    <script>
        $(document).ready(function() {
            $(".card").draggable({
                revert: "invalid", // La tarjeta volverá a su posición original si no se suelta en un área válida
                stack: ".card",
                cursor: "move"
            });

            $(".dropzone").droppable({
                accept: ".card",
                drop: function(event, ui) {
                    $(this).append(ui.draggable);
                }
            });
        });
    </script>


</body>