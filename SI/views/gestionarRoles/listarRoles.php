<?php
    $_title = "Roles";
    include('../templates/head.php');

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

// Como la funcionalidad de roles solo está permitida para el administrador
// No se debe permitir a empleados que no tengan un rol de Administrador
if ($idRole != 1) {
    echo "<script> window.alert('Usted no tienen permiso para acceder a esta funcionalidad');</script>";
    session_destroy();
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Importando clases
include_once('../../controllers/clases/rol.php');
$role = new Role();
$roles = $role->getRoles(); // Aqui se reciben en modo de Array la lista de roles
?>

<body>
    <div class="main-container">
        <?php include('../templates/menus/menuAdministrador.php') ?>

        <main>
            <div class="info-container">
                <h1>Lista de Roles</h1>
                
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($roles as $role) {
                            echo <<<HTML
                            <tr class="dataList">
                                <td>{$role['name']}</td>
                                <td>{$role['description']}</td>
                                <td><a href="modificarRoles.php?id={$role['ID']}">Modificar</a></td>
                            </tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</body>
</html>
