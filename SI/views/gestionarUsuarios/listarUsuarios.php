<?php
include_once('../../controllers/clases/usuario.php');

$user = new User();
$users = $user->getUsers();
?>

<?php
$_title = "Lista de Usuarios";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <div>
            <div class="tools">
                <div class="searchBar">
                    <input id="searchInput" placeholder="Buscar" />
                </div>
                <button id="create">Crear empleado</button>
            </div>

            <table class="table">
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
    </div>

    <script src="../../assets/js/gestionarUsuarios/listarUsuarios.js"></script>
</body>
</html>
