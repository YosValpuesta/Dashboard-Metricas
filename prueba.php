<div class="row lanes">
                    <div class="col-sm-4 swim-lane" id="todo-lane">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">Por hacer</h4>
                        </div>
                        <hr>
                        <?php
                        if (isset($_SESSION['HU'])) {
                            $arregloHU = $_SESSION['HU'];
                            for ($i = 0; $i < count($arregloHU); $i++) { ?>
                                <div class="card task" draggable="true">
                                    <div class="card-header">
                                        <h5 class="idHU"><?php echo $arregloHU[$i]["IdHU"] ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><?php echo $arregloHU[$i]["Nombre"] ?></li>
                                        <li class="list-group-item"><?php echo $arregloHU[$i]["PH"] ?></li>
                                        <li class="list-group-item"><?php echo $arregloHU[$i]["Responsable"] ?></li>
                                    </ul>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-sm-4 swim-lane" id="progress-lane">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">En progreso</h4>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-3 swim-lane" id="done-lane">
                        <div class="card-header" style="background-color: burlywood; border-radius: 16px; padding: 9px;">
                            <h4 class="card-title heading text-center">Hecho</h4>
                        </div>
                        <hr>
                    </div>
                </div>



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
        $fechaIni = $mostrar[6];

        $resultado = [
            'IdHU' => $_GET['numeroHU'],
            'Nombre' => $nombreHU,
            'PH' => $puntosH,
            'Responsable' => $responsableHU,
            'Estado' => $estadoHU,
            'Fecha' => $fechaIni
        ];

        $estadoHU = 'Por Hacer';
        $fechaIni = date("d-m-Y");

        if ($resultado) {
            // Agregar la HU a la sesión
            $arregloNuevo = array(
                'IdHU' => $_GET['numeroHU'],
                'Nombre' => $nombreHU,
                'PH' => $puntosH,
                'Responsable' => $responsableHU,
                'Estado' => $estadoHU,
                'Fecha' => $fechaIni
            );
            
            $_SESSION['HU'][] = $arregloNuevo;

            // Guardar la HU en la base de datos
            $queryInsert = "INSERT INTO hu_tablero (numeroHU, nombre, puntos, responsable, estado, fechaAgregada) VALUES ('$numeroHU', '$nombreHU', '$puntosH', '$responsableHU', '$estadoHU', '$fechaIni')";

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
                'Estado' => $estadoHU,
                'Fecha' => $fechaIni
            ];
        }

        $_SESSION['HU'] = $arreglo;
    }
}
?>



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
                                            <div>
                                                Fecha: <?php echo $hu["Fecha"]; ?>
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