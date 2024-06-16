<?php

$_title = "Gestion de Empleados";
include ('./../templates/head.php');

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

// Importando clases
include_once ('../../controllers/clases/usuario.php');
$user = new User();
$users = $user->getUsers(); // Aqui se reciben en modo de Array la lista de empleados
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
                <h1>Busque el Empleado</h1>
                <form action="">

                    <div class="search-container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>
                </form>

                <h1 style="margin-top: 20px;">Lista de Empleados</h1>
                <div class="tabla-container" style="margin-top: 10px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>ID de Licencia</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {

                                if ($user['idRole'] === 1) {
                                    continue;
                                }

                                echo <<<HTML
                                <tr class="dataList">
                                    <td>{$user['name']}</td>
                                    <td>{$user['lastName']}</td>
                                    <td>{$user['licenseID']}</td>
                                    <td>{$user['email']}</td>
                                    <td><a href="modificarUsuarios.php?id={$user['ID']}">Modificar</a></td>
                                </tr>
                                HTML;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="group_buttons">
                    <button id="create" ctype="button">Añadir un nuevo empleado</button>
                </div>
            </div>
        </main>
    </div>
    
    <script src="../../assets/js/gestionarUsuarios/listarUsuarios.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

</body>
</html>