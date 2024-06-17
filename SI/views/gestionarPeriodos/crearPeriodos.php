<?php

$_title = "Crear Periodo";
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

// Como la funcionalidad de periodos solo está permitida para el administrador
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
    include_once('../templates/menus/menuAdministrador.php');
    ?>

    <main>
        <div class="info-container">
            <h1 style="margin-bottom: 50px;">Crear Periodo</h1>
            <form id="form" action="../../controllers/gestionarPeriodos/crearPeriodos.php" method="post">
                <div class="form-grid_container_register">
                    <!-- Nombre -->
                    <div class="form-group_control">
                        <label for="name">Nombre:</label>
                        <input class="form-input" type="text" id="name" name="name">
                        <p id="nameError" class="error"></p>
                    </div>
                    <!-- Fecha de Inicio -->
                    <div class="form-group_control">
                        <label for="dateStart">Fecha de Inicio:</label>
                        <input class="form-input" type="date" id="dateStart" name="dateStart">
                        <p id="dateStartError" class="error"></p>
                    </div>
                    <!-- Fecha de Fin -->
                    <div class="form-group_control">
                        <label for="dateEnd">Fecha de Fin:</label>
                        <input class="form-input" type="date" id="dateEnd" name="dateEnd">
                        <p id="dateEndError" class="error"></p>
                    </div>
                </div>
                <div class="group_buttons">
                    <button id="btnGuardar" type="submit">Crear Periodo</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script src="../../assets/js/gestionarPeriodos/crearPeriodos.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</body>
</html>
