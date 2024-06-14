<?php
// Verifica si la sesión no ha sido iniciada, y si no es así, la inicia
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Recupera el rol del usuario desde la sesión
$idRole = $_SESSION['ID_ROLE'];
?>

<!-- Contenedor de la barra lateral -->
<div class="sidebar">
    <!-- Título del menú -->
    <h2>Menu</h2>
    <!-- Lista de elementos del menú -->
    <ul>
        <?php
        // Si el rol del usuario es 2 (Empleado), muestra un menú específico
        if ($idRole === 2) {
            echo <<<HTML
                <li><a href="../../views/dashboardEmpleados/dashboardEmpleados.php">Inicio</a></li>
                <li><a href="../../views/gestionarEstudiantes/listarEstudiantes.php">Estudiantes</a></li>
                <li><a href="../../views/gestionarInscripciones/listarinscripcion.php">Inscripciones</a></li>
                <li><a href="../../../controllers/gestionarAcceso/cerrarSesion.php">Cerrar Sesión</a></li>
            HTML;
        } else {
            // Si el rol del usuario no es 2, muestra un menú más completo
            echo <<<HTML
                <li><a href="../../views/dashboardEmpleados/dashboardEmpleados.php">Inicio</a></li>
                <li><a href="../../views/gestionarCarreras/listarCarreras.php">Carreras</a></li>
                <li><a href="../../views/gestionarEstudiantes/listarEstudiantes.php">Estudiantes</a></li>
                <li><a href="../../views/gestionarPeriodos/listarPeriodos.php">Periodos</a></li>
                <li><a href="../../views/gestionarRoles/listarRoles.php">Roles</a></li>
                <li><a href="../../views/gestionarInscripciones/listarinscripciones.php">Inscripciones</a></li>
                <!-- <li><a href="../../views/gestionarNotificaciones/listarNotificaciones.php">Notificaciones</a></li> -->
                <!-- <li><a href="../../views/gestionarReportes/listarReportes.php">Reportes</a></li> -->
                <li><a href="../../views/gestionarUsuarios/listarUsuarios.php">Empleados</a></li>
                <li><a href="../../../controllers/gestionarAcceso/cerrarSesion.php">Cerrar Sesión</a></li>
            HTML;
        }
        ?>
    </ul>
</div>
