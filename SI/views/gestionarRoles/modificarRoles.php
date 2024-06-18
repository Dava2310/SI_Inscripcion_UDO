<?php

session_start();
$_title = "Modificar Roles";
include ("../templates/head.php");

// Inicio de la Sesion
$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Como la funcionalidad de roles solo está permitida para el administrador
// No se debe permitir a empleados que no tengan un rol de Administrador
if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Importando la clase Roles
include_once ('../../controllers/clases/rol.php');

// Obteniendo los datos del rol segun el ID proveniente del Metodo GET
// Por el cual fue invocada esta pagina
$roleID = $_GET['id'];
$role = new Role();
$roleDetails = $role->getRoleByID($roleID);
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
                <h1>Modificar Rol</h1>

                <form id="form" action="../../controllers/gestionarRoles/modificarRoles.php?id=<?= $roleID ?>"
                    method="post">

                    <div class="form-grid_container_register_one_column">

                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" type="text" id="name" name="name"
                                value="<?= $roleDetails['name'] ?>">
                        </div>

                        <!-- Descripcion -->
                        <div class="form-group_control">
                            <label for="description">Descripción:</label>
                            <input class="form-input" type="text" id="description" name="description"
                                value="<?= $roleDetails['description'] ?>">
                        </div>

                        <div class="group_buttons">
                            <button type="button" onclick="clearValues()">Restaurar Valores</button>
                            <button id="btnGuardar" type="submit">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarRoles/modificarRoles.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function clearValues() {
            document.getElementById("form").reset();
        }
    </script>
</body>

</html>