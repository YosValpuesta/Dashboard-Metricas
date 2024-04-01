<?php
include 'ConexionBD/conexion.php';
session_start();

// Verificar si existe una sesión de usuario
if (isset($_SESSION['Usuario'])) {
    // Verificar si se ha enviado una HU para agregar
    if (isset($_GET['numeroHU'])) {
        $numeroHU = $_GET['numeroHU'];

        // Verificar si la HU ya está agregada a la sesión
        if (isset($_SESSION['HU'])) {
            $arreglo = $_SESSION['HU'];
            $encontro = false;
            foreach ($arreglo as $hu) {
                if ($hu['IdHU'] == $numeroHU) {
                    $encontro = true;
                    break;
                }
            }
            if ($encontro) {
                $_SESSION['error'] = 'La HU ya está agregada';
                header("Location: backlog.php");
                exit();
            }
        }

        $resultado = $conexion->query('SELECT * FROM hu WHERE numeroHU = ' . $_GET['numeroHU']) or die($conexion->error);
        $mostrar = mysqli_fetch_row($resultado);
        $nombreHU = $mostrar[1];
        $puntosH = $mostrar[3];
        $responsableHU = $mostrar[4];
        $estadoHU = $mostrar[8];

        $resultado = [
            'IdHU' => $_GET['numeroHU'],
            'Nombre' => $nombreHU,
            'PH' => $puntosH,
            'Responsable' => $responsableHU,
            'Estado' => $estadoHU
        ];

        $estadoHU = 'Por Hacer';

        if ($resultado) {
            // Agregar la HU a la sesión
            $arregloNuevo = array(
                'IdHU' => $_GET['numeroHU'],
                'Nombre' => $nombreHU,
                'PH' => $puntosH,
                'Responsable' => $responsableHU,
                'Estado' => $estadoHU
            );
            $_SESSION['HU'][] = $arregloNuevo;


            // Guardar la HU en la base de datos
            $queryInsert = "INSERT INTO hu_tablero (numeroHU, nombre, puntos, responsable, estado) VALUES ('$numeroHU', '$nombreHU', '$puntosH', '$responsableHU', '$estadoHU')";

            $conexion->query($queryInsert) or die($conexion->error);
        }
    }
}

// Recuperar las HU al iniciar sesión
if (isset($_SESSION['Usuario'])) {
    if (!isset($_SESSION['HU'])) {
        // Consultar las HU desde la base de datos
        $querySelect = "SELECT * FROM hu_tablero";
        $resultSelect = $conexion->query($querySelect) or die($conexion->error);

        $arreglo = [];
        while ($row = mysqli_fetch_assoc($resultSelect)) {
            // Obtener el estado directamente de la fila en la base de datos
            $estadoHU = $row['estado'];

            $arreglo[] = [
                'IdHU' => $row['numeroHU'],
                'Nombre' => $row['nombre'],
                'PH' => $row['puntos'],
                'Responsable' => $row['responsable'],
                'Estado' => $estadoHU
            ];
        }

        $_SESSION['HU'] = $arreglo;
    }
}
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Tablero kanban</title>
    <link rel="stylesheet" href="css/styles.css" />
    <!-- <script src="js/drag.js" defer></script> -->
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
                            <h4 class="card-title heading text-center">Por hacer</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['HU'])) {
                                $arregloHU = $_SESSION['HU'];
                                foreach ($arregloHU as $hu) {
                                    if ($hu['Estado'] == 'Por Hacer') {  // Filtrar por estado "Por hacer"
                            ?>
                                        <div class="card" id="hu_<?php echo $hu["IdHU"]; ?>">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                <h5><?php echo $hu["IdHU"]; ?>: <?php echo $hu["Nombre"]; ?></h5>
                                            </button>
                                            <div>
                                                Estado: <?php echo $hu["Estado"]; ?>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button type="button" class="btn btn-sm btn-outline-success" onclick="comenzarHU(<?php echo $hu["IdHU"]; ?>)">Comenzar HU</button>
                                            </div>
                                        </div>
                                        <br>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-4 swim-lane" id="EnProgreso">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">En progreso</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['HU'])) {
                                $arregloHU = $_SESSION['HU'];
                                foreach ($arregloHU as $hu) {
                                    if ($hu['Estado'] == 'En progreso') {  // Filtrar por estado "En progreso"
                            ?>
                                        <div class="card" id="hu_<?php echo $hu["IdHU"]; ?>">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                <h5><?php echo $hu["IdHU"]; ?>: <?php echo $hu["Nombre"]; ?></h5>
                                            </button>
                                            <div>
                                                Estado: <?php echo $hu["Estado"]; ?>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button type="button" class="btn btn-sm btn-outline-success" onclick="comenzarHU(<?php echo $hu["IdHU"]; ?>)">Comenzar HU</button>
                                            </div>
                                        </div>
                                        <br>
                            <?php
                                    }
                                }
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

<!-- <p class="task" draggable="true"></p> -->

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
    function comenzarHU(idHU) {
        // Aquí puedes hacer una petición AJAX para actualizar el estado en la base de datos
        // y luego mover la tarjeta a la columna "En progreso" en la interfaz

        // Ejemplo de solicitud AJAX con jQuery
        $.ajax({
            url: 'CRUD/tablero/actualizarEstadoHU.php', // URL del script PHP que actualiza el estado
            method: 'POST',
            data: {
                idHU: idHU,
                nuevoEstado: 'En progreso'
            },
            success: function(response) {
                if (response.success) {
                    // Si la actualización en la base de datos fue exitosa
                    // Mover la tarjeta a la columna "En progreso"
                    var tarjeta = $('#hu_' + idHU);
                    tarjeta.appendTo('#Progreso .card-body');
                } else {
                    console.error(response.message); // Mostrar mensaje de error si es necesario
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // Manejar errores de la solicitud AJAX
            }
        });
    }
</script>



<!-- <script>
    function eliminarHU(idHU) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "CRUD/tablero/eliminarTablero.php?id=" + idHU, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // La eliminación se realizó correctamente, recargar la página
                location.reload();
            } else {
                // Error al eliminar la HU, mostrar mensaje de error si es necesario
                console.error(response.message);
            }
        }
    };
    xhr.send();
}

</script> -->