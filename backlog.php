<?php
include 'ConexionBD/conexion.php';
$historiasUsuario = "SELECT * FROM hu";
$resultado = $conexion->query($historiasUsuario);
?>


<head>
    <title>CorsolaCorp: Backlog</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column" style="background-color: #90AFC5;">
            <div id="content">
                <?php include 'navPrincipal.html' ?>
                <div class="container">
                    <br>
                    <div class="accordion" id="accordionExample">
                        <div class="card text-center">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-center" type="button" data-toggle="collapse" data-target="#sprint1" aria-expanded="true" aria-controls="sprint1">
                                        Backlog
                                    </button>
                                </h2>
                            </div>
                            <div id="sprint1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Agregar Historia de usuario
                                    </button>
                                    <hr>
                                    <div class="row">
                                        <?php
                                        while ($mostrar = $resultado->fetch_assoc()) {
                                        ?>
                                            <div class="col-sm-3" style="padding: 5px;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <button type="button" class="btn">
                                                                        HU: <?php echo $mostrar["numeroHU"]; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-7">
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <button style="opacity: 20%;" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                        Opciones
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="kanban.php?numeroHU=<?php echo $mostrar['numeroHU'] ?>">Añadir al Tablero</a>
                                                                        <a class="dropdown-item" href="#">Editar</a>
                                                                        <a class="dropdown-item" href="CRUD/eliminarHU.php?id=<?php echo $mostrar['numeroHU'] ?>">Eliminar</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h5 class="card-title text-center"><?php echo $mostrar["Nombre"]; ?></h5>
                                                        <p class="card-text">Descripción: <?php echo $mostrar["Descripcion"]; ?></p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">PH: <?php echo $mostrar["PH"]; ?></li>
                                                        <li class="list-group-item">Responsable: <?php echo $mostrar["Responsable"]; ?></li>
                                                        <li class="list-group-item">Estado: <?php echo $mostrar["Estado"]; ?></li>
                                                        <li class="list-group-item">Sprint: <?php echo $mostrar["Sprint"]; ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php include 'footer.html' ?>
        </div>
    </div>

    <!-- Modal para nueva HU -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Historia de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="CRUD/nuevaHU.php" method="POST">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Nombre</span>
                            </div>
                            <input REQUIRED type="text" class="form-control" name="NombreHU">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Descripción</span>
                            </div>
                            <textarea REQUIRED class="form-control" name="DescripcionHU" cols="5" rows="2"></textarea>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">PH</span>
                            </div>
                            <select REQUIRED class="form-control" name="PH">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="8">8</option>
                                <option value="13">13</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Responsable</span>
                            </div>
                            <select REQUIRED class="form-control" name="ResponsableHU">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Sprint</span>
                            </div>
                            <select REQUIRED class="form-control" name="SprintHU">
                                <?php
                                for ($i = 1; $i <= $totalSprint; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar a Backlog</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>