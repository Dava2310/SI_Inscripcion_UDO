<?php

$_title = "Crear Carrera";
include ('../templates/head.php');

// Inicio de la Sesion
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
?>

<body>
    <div class="main-container">
        <?php
        // No hacemos la verificación de qué menú desplegar
        // Ya que esta pantalla solo debería ser visible para un Administrador
        include ('../templates/menus/menuAdministrador.php');
        ?>

        <main>
            <div class="info-container">
                <h1>Crear Carrera</h1>
                <form id="form" action="../../controllers/gestionarCarreras/crearCarreras.php" method="post">
                    <div class="form-grid_container_register_one_column">

                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" type="text" id="name" name="name" required>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group_control">
                            <label for="description">Descripción:</label>
                            <input class="form-input" type="text" id="description" name="description" required>
                        </div>

                        <!-- Código -->
                        <div class="form-group_control">
                            <label for="code">Código:</label>
                            <input class="form-input" type="text" id="code" name="code" required>
                        </div>
                    </div>

                    <div class="group_buttons">
                        <button type="button" onclick="clearValues()">Limpiar Valores</button>
                        <button id="btnGuardar" type="submit">Crear Carrera</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function clearValues() {
            document.getElementById("form").reset();
        }
    </script>

    <script src="../../assets/js/gestionarCarreras/crearCarreras.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>