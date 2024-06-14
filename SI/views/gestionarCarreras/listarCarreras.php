<?php
include_once('../../controllers/clases/carrera.php');

$career = new Career();
$careers = $career->getCareers();
?>

<?php
$_title = "Carreras";
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
                <button id="create">Crear Carrera</button>
            </div>

            <table class="table">
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
    </div>
    <script src="../../assets/js/gestionarCarreras/listarCarreras.js"></script>
</body>

</html>
