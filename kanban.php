<?php
include 'ConexionBD/conexion.php';
session_start();

//Limite WIP
$resultado = $conexion->query("SELECT * FROM metricawip") or die($conexion->error);
$WIP = mysqli_fetch_assoc($resultado);
$PorHacerWIP = $WIP['valorPorHacer'];
$HaciendoWIP = $WIP['valorHaciendo'];
$TerminadoWIP = $WIP['valorTerminado'];
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Tablero kanban</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">
    <?php include 'alertas.php' ?>
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="row lanes">

                    <div class="col-sm-4 swim-lane" id="PorHacer">

                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">Por hacer : (<?php echo $PorHacerWIP ?>)</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <?php
                            $resultado = $conexion->query("SELECT * FROM hu_tablero WHERE estado = 'Por Hacer'") or die($conexion->error);
                            while ($mostrarHU = mysqli_fetch_assoc($resultado)) {

                            ?>
                                <div class="card" id="HU">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <h5><?php echo $mostrarHU['numeroHU'] ?> : <?php echo $mostrarHU['nombre'] ?></h5>
                                    </button>
                                    <!-- <div>
                                        Estado: <?php echo $mostrarHU['estado'] ?>
                                    </div>
                                    <div>
                                        Fecha: <?php echo $mostrarHU['FechaAgregada'] ?>
                                    </div> -->
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-sm btn-outline-success" onclick="comenzarHU(<?php echo $mostrarHU['numeroHU'] ?>)">Comenzar HU</button>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-4 swim-lane" id="EnProgreso">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">En progreso : (<?php echo $HaciendoWIP ?>)</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <?php
                            // Consultar la base de datos para obtener las HU en estado "Por Hacer"
                            $resultado = $conexion->query("SELECT * FROM hu_tablero WHERE estado = 'En progreso'") or die($conexion->error);
                            while ($mostrarHU = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <div class="card" id="HU">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <h5><?php echo $mostrarHU['numeroHU'] ?> : <?php echo $mostrarHU['nombre'] ?></h5>
                                    </button>
                                    <!-- <div>
                                        Estado: <?php echo $mostrarHU['estado'] ?>
                                    </div>
                                    <div>
                                        Fecha: <?php echo $mostrarHU['FechaAgregada'] ?>
                                    </div> -->
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-sm btn-outline-success" onclick="finalizarHU(<?php echo $mostrarHU['numeroHU'] ?>)">Finalizar HU</button>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-3 swim-lane" id="Terminada">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">Terminado: (<?php echo $TerminadoWIP ?>)</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <?php
                            // Consultar la base de datos para obtener las HU en estado "Por Hacer"
                            $resultado = $conexion->query("SELECT * FROM hu_tablero WHERE estado = 'Terminada'") or die($conexion->error);
                            while ($mostrarHU = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <div class="card" id="HU">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <h5><?php echo $mostrarHU['numeroHU'] ?> : <?php echo $mostrarHU['nombre'] ?></h5>
                                    </button>
                                    <!-- <div>
                                        Estado: <?php echo $mostrarHU['estado'] ?>
                                    </div>
                                    <div>
                                        Fecha: <?php echo $mostrarHU['FechaAgregada'] ?>
                                    </div> -->

                                </div>
                                <br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
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

<script>
    function comenzarHU(numeroHU) {
        // Enviar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'CRUD/tablero/actualizarEstadoHU.php',
            data: {
                numeroHU: numeroHU
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Imprimir la respuesta en la consola para depurar
                if (response.success) {
                    // Actualizar la interfaz de usuario
                    alert('La HU se ha movido a "En progreso"');
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                location.reload();
            }
        });
    }
</script>

<script>
    function finalizarHU(numeroHU) {
        // Enviar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'CRUD/tablero/finalizarHU.php',
            data: {
                numeroHU: numeroHU
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Imprimir la respuesta en la consola para depurar
                if (response.success) {
                    // Actualizar la interfaz de usuario
                    alert('La HU se ha movido a "Terminado"');
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                location.reload();
            }
        });
    }
</script>