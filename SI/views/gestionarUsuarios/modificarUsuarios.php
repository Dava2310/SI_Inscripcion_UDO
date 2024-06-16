<?php

$_title = "Modificar Empleado";
include ("../templates/head.php");

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

// Como la funcionalidad de usuarios solo está permitida para el administrador
// No se debe permitir a empleados que no tengan un rol de Administrador
if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Importando la clase Usuario
include_once ('../../controllers/clases/usuario.php');

// Obteniendo los datos del usuario segun el ID proveniente del Metodo GET
// Por el cual fue invocada esta pagina
$userID = $_GET['id'];
$user = new User();
$userDetails = $user->getUserByID($userID);
?>

<body>

    <div class="main-container">
        <?php
        // No hacemos la verificacion de que menu desplegar
        // Ya que esta pantalla solo deberia ser visible para un Administrador
        include ('../templates/menus/menuAdministrador.php');
        ?>

        <main>
            <div class="info-container">
                <h1>Modificar Empleado</h1>
                <form id="form" action="../../controllers/gestionarUsuarios/modificarUsuarios.php?id=<?= $userID ?>"
                    method="post">

                    <div class="form-grid_container_register_one_column">
                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" type="text" id="name" name="name"
                                value="<?= $userDetails['name'] ?>">
                            <p id="errorName"></p>
                        </div>
                        <!-- Apellido -->
                        <div class="form-group_control">
                            <label for="lastName">Apellido:</label>
                            <input class="form-input" type="text" id="lastName" name="lastName"
                                value="<?= $userDetails['lastName'] ?>">
                            <p id="errorLastname"></p>
                        </div>
                        <!-- Correo -->
                        <div class="form-group_control">
                            <label for="email">Correo Electrónico:</label>
                            <input class="form-input" type="email" id="email" name="email"
                                value="<?= $userDetails['email'] ?>">
                            <p id="errorEmail"></p>
                        </div>
                        <!-- Cedula -->
                        <div class="form-group_control">
                            <label for="licenseID">Cedula:</label>
                            <input class="form-input" type="text" id="licenseID" name="licenseID" value="<?= $userDetails['licenseID'] ?>">
                            <p id="errorLicenseID"></p>
                        </div>
                    </div>
                    <div class="group_buttons">
                        <button type="button" onclick="clearValues()">Restaurar Valores</button>
                        <button id="btnGuardar" type="submit">Guardar Cambios</button>
                        <button type="button" id="delete">Eliminar Empleado</button>     
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarUsuarios/modificarUsuarios.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</body>
</html>