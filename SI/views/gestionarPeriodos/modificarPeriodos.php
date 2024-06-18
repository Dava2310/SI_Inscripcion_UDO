<?php
session_start();
$_title = "Modificar Periodo";
include ('../templates/head.php');

// Inicio de la Sesion

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

// Importando la clase Periodo
include_once ('../../controllers/clases/periodo.php');

// Obteniendo los datos del periodo segun el ID proveniente del Metodo GET
// Por el cual fue invocada esta pagina
$periodID = $_GET['id'];
$period = new Period();
$periodDetails = $period->getPeriodByID($periodID);
$periodStatus = $periodDetails['validity'];
?>

<body>
    <div class="main-container">
        <?php include ('../templates/menus/menuAdministrador.php') ?>

        <main>
            <div class="info-container">
                <h1>Modificar Periodo</h1>
                <form id="form" action="../../controllers/gestionarPeriodos/modificarPeriodos.php?id=<?= $periodID ?>"
                    method="post">
                    <div class="form-grid_container_register_one_column">
                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" value="<?= $periodDetails['name'] ?>"
                                class="form-input">
                            <span id="nameError" class="error" style="color: red;"></span>
                        </div>

                        <!-- Fecha de Inicio -->
                        <div class="form-group_control">
                            <label for="dateStart">Fecha de Inicio:</label>
                            <input type="date" id="dateStart" name="dateStart"
                                value="<?= $periodDetails['dateStart'] ?>" class="form-input">
                            <span id="dateStartError" class="error" style="color: red;"></span>
                        </div>

                        <!-- Fecha de Fin -->
                        <div class="form-group_control">
                            <label for="dateEnd">Fecha de Fin:</label>
                            <input type="date" id="dateEnd" name="dateEnd" value="<?= $periodDetails['dateEnd'] ?>"
                                class="form-input">
                            <span id="dateEndError" class="error" style="color: red;"></span>
                        </div>

                        <!-- Acciones -->
                        <div class="group_buttons">
                            <button type="submit" id="save">Guardar Cambios</button>
                            <button type="button" id="delete">Eliminar Periodo</button>
                            <button type="button" id="activate">Empezar Periodo</button>
                            <button type="button" id="finish">Terminar Periodo</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        const periodStatus = <?= $periodStatus ?>;
        const periodID = <?= $periodID ?>;
    </script>
    <script src="../../assets/js/gestionarPeriodos/modificarPeriodos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</body>
</html>