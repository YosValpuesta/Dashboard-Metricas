<?php
include 'ConexionBD/conexion.php';
session_start();

$querySprints = $conexion->query("SELECT * FROM tablero") or die($conexion->error);
$mostrarSprint = mysqli_fetch_array($querySprints);
$totalSprints = $mostrarSprint['TotalSprint']

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
                <h1>Metrica WIP: Work in progress</h1>
                <div class="container">
                    <div class="card text-center">
                        <form action="metricas/agregarWIP.php" method="POST">
                            <div class="card-header">
                                WIP por columna
                            </div>
                            <div class="card-body">
                                <p class="card-text">Agrega un valor limite a cada columna del tabler</p>
                                <hr>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">WIP: "Por hacer"</span>
                                    </div>
                                    <input REQUIRED type="number" min="1" max="50" class="form-control" name="valorPorHacer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">WIP: "Haciendo"</span>
                                    </div>
                                    <input REQUIRED type="number" min="1" max="50" class="form-control" name="valorHaciendo">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">WIP: "Terminado"</span>
                                    </div>
                                    <input REQUIRED type="number" min="1" max="50" class="form-control" name="valorTerminado">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Sprint</span>
                                        <select REQUIRED class="form-control" name="SprintHU">
                                            <?php for ($i = 1; $i <= $totalSprints; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="nombre" value="<?php echo $mostrarSprint['Nombre'] ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar WIP</button>
                            </div>
                        </form>
                        <div class="card-footer text-muted">
                            Proyecto: <?php echo $mostrarSprint['Nombre'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

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