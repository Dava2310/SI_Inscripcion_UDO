<div class="sidebarBackground">
    <!-- Contenedor para la barra lateral -->
    <div class="sidebar">
        <!-- Título del menú -->
        <h2>Menu</h2>
        <!-- Lista de elementos del menú -->
        <ul>
            <!-- Enlace al inicio del dashboard de estudiantes -->
            <li><a href="../../views/dashboardEstudiantes/dashboardEstudiantes.php">Inicio</a></li>
            
            <!-- Opción de menú para solicitar inscripción con submenú desplegable -->
            <li>
                <a href="#">Solicitar Inscripción</a>
                <ul class="submenu">
                    <div>
                        <!-- Submenú con los pasos para crear una inscripción -->
                        <li><a class="submenu-item" href="../../views/gestionarInscripciones/crearInscripcionPasoUno.php">Paso 1: Datos básicos</a></li>
                        <li><a class="submenu-item" href="../../views/gestionarInscripciones/crearInscripcionPasoDos.php">Paso 2: Selección Carrera</a></li>
                        <li><a class="submenu-item" href="../../views/gestionarInscripciones/crearInscripcionPasoTres.php">Paso 3: Subir Documentos</a></li>
                    </div>
                </ul>
            </li>

            <!-- Enlace para ver inscripción -->
            <li><a href="../../views/gestionarInscripciones/verInscripcion.php">Ver Inscripción</a></li>

            <!-- Enlace para cerrar sesión -->
            <li><a href="../../controllers/gestionarAcceso/cerrarSesion.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>
