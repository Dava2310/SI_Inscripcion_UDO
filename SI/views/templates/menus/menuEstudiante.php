
<nav class="navbar_container">
    <ul class="navbar_content">
        <li>
            <a href="../../views/dashboardEstudiantes/dashboardEstudiantes.php">Inicio</a>
        </li>
        <li>
            <a href="#">Inscripciones</a>
            <ul>
                <div>
                    <!-- Submenú con los pasos para crear una inscripción -->
                    <li><a href="../../views/gestionarInscripciones/crearInscripcionPasoUno.php">Paso 1: Datos básicos</a></li>
                    <li><a href="../../views/gestionarInscripciones/crearInscripcionPasoDos.php">Paso 2: Selección Carrera</a></li>
                    <li><a href="../../views/gestionarInscripciones/crearInscripcionPasoUno.php">Paso 3: Subir Documentos</a></li>
                </div>
            </ul>
        </li>
        <li>
            <a href="../../views/gestionarInscripciones/verInscripcion.php">Ver Inscripcion</a>
        </li>
    </ul>

    <a class="closeSession_button" href="../../controllers/gestionarAcceso/cerrarSesion.php">
        <p>Cerrar Sesión</p>

        <img src="../../assets/img/log-out.png" alt="">
    </a>
</nav>
