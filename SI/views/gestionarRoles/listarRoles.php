<?php
include_once('../../controllers/clases/rol.php');
$role = new Role();
$roles = $role->getRoles();
?>

<?php
$title = "Roles";
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
            <table class="table">
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
    </div>
</body>
</html>
