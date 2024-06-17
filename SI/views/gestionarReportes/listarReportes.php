<?php
$_title = "Panel De Reportes";
include ('../templates/head.php');

// Inicio de la sesion
session_start();
$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Como la funcionalidad de carreras solo está permitida para el administrador
// No se debe permitir a empleados que no tengan un rol de Administrador
if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// IMPORTANDO CLASES
?>

<body>

    <div class="main-container">
        <?php
        include ('../templates/menus/menuAdministrador.php');
        ?>

        <main>
            <div class="info-container">
                <h1>Seleccione el Reporte a Generar</h1>

                <form id="formSolicitudes" method="post" target="_blank" action="../libreriaPDF/reporteInscripciones.php">

                    <button type="submit">Generar Reporte de Solicitudes de Inscripciones</button>

                </form>

                <form id="formEstudiantes" method="post" target="_blank" action="../libreriaPDF/reporteEstudiantes.php">

                    <button type="submit">Generar Reporte de Estudiantes</button>

                </form>
            </div>
        </main>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>