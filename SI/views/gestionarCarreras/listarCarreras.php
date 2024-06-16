<?php
$_title = "Gestion de Carreras";
include ('./../templates/head.php');

// Importando clases
include_once ('../../controllers/clases/carrera.php');
$career = new Career();
$careers = $career->getCareers();

// Inicio de la sesion
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
        <!-- CONTENIDO DEL MENU DE NAVEGACION -->
        <?php
        if ($idRole === 1) {
            include ('../templates/menus/menuAdministrador.php');
        } else {
            include ('../templates/menus/menuEmpleado.php');
        }

        ?>

        <main>
            <div class="info-container">

                <h1>Busque la Carrera</h1>
                <form action="">

                    <div class="search_container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>

                </form>

                <h1 style="margin-top: 20px;">Lista de Carreras</h1>
                <div class="tabla-container" style="margin-top: 10px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($careers as $career) {
                                echo <<<HTML
                                <tr class="dataList">
                                    <td>{$career['name']}</td>
                                    <td>{$career['description']}</td>
                                    <td>{$career['code']}</td>
                                    <td><a href="modificarCarreras.php?id={$career['ID']}">Modificar</a></td>
                                </tr>
                                HTML;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="group_buttons">
                    <button id="create" ctype="button">Añadir una nueva carrera</button>
                </div>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarCarreras/listarCarreras.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>