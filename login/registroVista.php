<?php session_start(); ?>

<head>
    <title>Dashboard: Registro de cuenta</title>
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
            <div class="col-xl-8 col-lg-10 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="p-3">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-3">Registro de cuenta</h1>
                        </div>
                        <hr>
                        <form action="validar/registrarse.php" method="POST">
                            <div class="container" id="informacionCuenta">
                                <h5 class="text-center">Información de la cuenta</h5>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Correo electrónico</span>
                                    </div>
                                    <input REQUIRED type="email" class="form-control" name="Correo" placeholder="cuenta@algo.com">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Usuario</span>
                                    </div>
                                    <input REQUIRED minlength="4" type="text" class="form-control" name="Usuario" id="bloque">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Contraseña</span>
                                    </div>
                                    <input REQUIRED minlength="8" type="password" class="form-control" name="Contraseña" id="txtContraseña">
                                    <span id="ShowPassword" onclick="mostrarPassword()" class="fa fa-eye-slash icon"></span>
                                </div>
                            </div>
                            <hr>
                            <div class="container" id="informacionPersonal">
                                <h5 class="text-center">Información personal</h5>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                                    </div>
                                    <input REQUIRED type="text" class="form-control" onblur="upperCase()" name="Nombre" placeholder="Nombre(s)" id="datos">
                                    <input REQUIRED type="text" class="form-control" onblur="upperCase1()" name="Apellidos" placeholder="Apellidos" id="datos1">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rol</span>
                                    </div>
                                    <select REQUIRED class="form-control" name="Rol">
                                        <option selected value="Desarrollador">Desarrollador</option>
                                        <option value="Tester">Tester</option>
                                        <option value="Analista de datos">Analista de datos</option>
                                        <option value="Diseñador">Diseñador</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <center><button type="submit" class="btn" id="registro">Crear cuenta</button></center>
                        </form>
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

        function upperCase() {
            var x = document.getElementById("datos").value
            document.getElementById("datos").value = x.toUpperCase()
        }

        function upperCase1() {
            var y = document.getElementById("datos1").value
            document.getElementById("datos1").value = y.toUpperCase()
        }
    </script>

</body>