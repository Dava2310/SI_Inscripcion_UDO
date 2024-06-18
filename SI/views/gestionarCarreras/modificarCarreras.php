<?php

$_title = "Modificar Carrera";
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

// Como la funcionalidad de carreras solo está permitida para el administrador
// No se debe permitir a empleados que no tengan un rol de Administrador
if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Importando la clase Carrera
include_once ('../../controllers/clases/carrera.php');

// Obteniendo los datos de la carrera segun el ID proveniente del Metodo GET
// Por el cual fue invocada esta pagina
$careerID = $_GET['id'];
$career = new Career();
$careerDetails = $career->getCareerByID($careerID);
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
                <h1>Modificar Carrera</h1>
                <form id="form" action="../../controllers/gestionarCarreras/modificarCarreras.php?id=<?= $careerID ?>"
                    method="post">
                    <div class="form-grid_container_register_one_column">
                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" type="text" id="name" name="name"
                                value="<?= $careerDetails['name'] ?>">
                        </div>
                        <!-- Descripción -->
                        <div class="form-group_control">
                            <label for="description">Descripción:</label>
                            <input class="form-input" type="text" id="description" name="description"
                                value="<?= $careerDetails['description'] ?>">
                        </div>
                        <!-- Código -->
                        <div class="form-group_control">
                            <label for="code">Código:</label>
                            <input class="form-input" type="text" id="code" name="code"
                                value="<?= $careerDetails['code'] ?>">
                        </div>
                    </div>
                    <div class="group_buttons">
                        <button type="button" onclick="clearValues()">Restaurar Valores</button>
                        <button id="btnGuardar" type="submit">Guardar Cambios</button>
                        <button type="button" id="delete">Eliminar Carrera</button>
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

    <script src="../../assets/js/gestionarCarreras/modificarCarreras.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>