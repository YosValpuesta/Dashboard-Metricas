<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
/* Alerta error */
if (isset($_SESSION['error'])) {
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo $_SESSION['error']; ?>',
            footer: '<a href=""></a>'
        })
    </script>
<?php
    unset($_SESSION['error']);
}

/* Alerta Usuario registrado */
if (isset($_SESSION['exito'])) {
?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '<?php echo $_SESSION['exito']; ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
<?php
    unset($_SESSION['exito']);
}

/* Alerta modificacion correcta */
if (isset($_SESSION['exitoUpdate'])) {
?>
    <script>
        Swal.fire(
            'Exito!',
            '<?php echo $_SESSION['exitoUpdate']; ?>',
            'success'
        )
    </script>
<?php
    unset($_SESSION['exitoUpdate']);
}

/* Alerta eliminacion correcta */
if (isset($_SESSION['exitoDelete'])) {
?>
    <script>
        Swal.fire(
            'Éxito!',
            '<?php echo $_SESSION['exitoDelete']; ?>',
            'success'
        )
    </script>
<?php
    unset($_SESSION['exitoDelete']);
}

/* Alerta sesion iniciada */
if (isset($_SESSION['inicioSesion'])) {
?>
    <script>
        Swal.fire(
            'Sesión iniciada!',
            'Bienvenido: <?php echo $_SESSION['inicioSesion']; ?>',
            'success'
        )
    </script>
<?php
    unset($_SESSION['inicioSesion']);
}

/* Alerta sesion denegada */
if (isset($_SESSION['inicioDenegado'])) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Acceso denegado',
                text: '<?php echo $_SESSION['inicioDenegado']; ?>',
            })
        </script>
    <?php
        unset($_SESSION['inicioDenegado']);
    }

    