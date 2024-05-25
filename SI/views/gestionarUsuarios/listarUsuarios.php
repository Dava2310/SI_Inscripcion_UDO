<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/usuario.php');

// Crear una instancia de la clase Student
$user = new Usuario();

// Obtener la lista de estudiantes
$users = $user->getUsers();
?>

<?php
$title = "Panel De Control";
include('../templates/encabezadoConfig.php');
?>

<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
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
                    // Recorrer la lista de estudiantes y mostrar su información en filas de la tabla
                    foreach ($users as $user) {
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