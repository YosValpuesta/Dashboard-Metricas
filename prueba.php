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