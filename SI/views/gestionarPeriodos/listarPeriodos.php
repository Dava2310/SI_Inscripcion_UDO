<?php
session_start();
$_title = "Gestion de Periodos";
include ('./../templates/head.php');

// Inicio de la Sesion

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

// Importando clases
include_once ('../../controllers/clases/periodo.php');
$period = new Period();
$periods = $period->getPeriods(); // Aqui se reciben en modo de Array la lista de Empleados
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
                <h1>Busque el Periodo</h1>
                <form action="">
                    <div class="search-container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>
                </form>

                <h1 style="margin-top: 20px;">Lista de Periodos</h1>
                <div class="tabla-container" style="margin-top: 10px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Vigente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($periods as $period) {

                                $validity;

                                switch ($period['validity']) {
                                    case 0:
                                        $validity = 'Sin empezar';
                                        break;
                                    case 1:
                                        $validity = 'Empezado';
                                        break;
                                    case 2:
                                        $validity = 'Terminado';
                                }

                                $actionStatus = $period['validity'] != 2 ? "Modificar" : "Ver";

                                echo <<<HTML
                                <tr class="dataList">
                                    <td>{$period['name']}</td>
                                    <td>{$period['dateStart']}</td>
                                    <td>{$period['dateEnd']}</td>
                                    <td>{$validity}</td>
                                    <td><a href="modificarPeriodos.php?id={$period['ID']}">{$actionStatus}</a></td>
                                </tr>
                                HTML;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="group_buttons">
                    <button id="create" type="button">Crear Periodo</button>
                </div>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarPeriodos/listarPeriodos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>