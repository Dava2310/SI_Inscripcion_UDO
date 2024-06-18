<?php
session_start();
$_title = "Crear Notificacion";
include_once('../templates/head.php');


$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

?>

<body>

    <div class="main-container">
        <?php
        include_once('../templates/menus/menuAdministrador.php');
        ?>

        <main>
            <div class="info-container">
                <h1 style="margin-bottom: 50px;">Crear Periodo</h1>
                <form id="form" action="../../controllers/gestionarNotificaciones/crearNotificaciones.php" method="post">
                    <div class="form-grid_container_register">
                        <div id="content" class="form-group_control">
                            <label for="content">Contenido</label>
                            <textarea class="content form-textArea" id="content" name="content" placeholder="Escriba la notificacion global"></textarea>
                        </div>
                    </div>
                    <div class="group_buttons">
                        <button id="btnGuardar" type="submit">Crear Notificacion</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarNotificaciones/crearNotificaciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>