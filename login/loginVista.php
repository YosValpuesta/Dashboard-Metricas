<?php session_start(); ?>

<head>
    <title>Dashboard: Login</title>
    <script src="https://kit.fontawesome.com/be3b2da769.js" crossorigin="anonymous"></script>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include '../alertas.php' ?>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="../img/InicioSesion.jpg" alt="" height="420px" width="500px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1>Inicio sesión</h1>
                                    </div>
                                    <hr>
                                    <form action="validar/iniciar.php" class="user" method="POST">
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="mr-3 d-lg-inline large">
                                                    Usuario <i class="fa-solid fa-user"></i>
                                                </span>
                                            </div>
                                            <input REQUIRED type="text" class="form-control" name="Usuario" placeholder="Usuario">
                                        </div>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="mr-3 d-lg-inline large">
                                                    Contraseña <i class="fa-solid fa-unlock"></i>
                                                </span>
                                            </div>
                                            <input REQUIRED type="password" class="form-control" name="Contraseña" placeholder="Contraseña" id="txtContraseña">
                                            &nbsp;&nbsp;
                                            <span class="fa fa-eye-slash icon mr-1" id="ShowPassword" onclick="mostrarPassword()"></span>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-block" id="iniciar">Iniciar sesión</button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="btn btn-block" href="registroVista.php" id="registro">Registrarse</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
        function mostrarPassword() {
            var cambio = document.getElementById("txtContraseña");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function() {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function() {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>

</body>