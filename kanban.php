<?php
include 'ConexionBD/conexion.php';
if (isset($_GET['numeroHU'])) {
    $numeroHU = $_GET['numeroHU'];

    $consulta = "SELECT * FROM hu WHERE numeroHU = $numeroHU";
    $resultado = $conexion->query($consulta);
}
?>

<head>
    <title>CorsolaCorp: Tablero kanban</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.html' ?>
                <!-- <?php echo "Número de HU: " . $numeroHU; ?> -->
                <br><br>
                <div class="dropzone">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4" style="background-color: pink">
                                <br>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h5 class="card-title">Por hacer</h5>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">En progreso</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Hecho</h5>
                                    </div>
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
                // } ?>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CorsolaCorp 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Cerrar sesión-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
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