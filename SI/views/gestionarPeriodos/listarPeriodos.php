<?php
include_once('../../controllers/clases/periodo.php');

$period = new Period();
$periods = $period->getPeriods();
?>

<?php
$_title = "Periodos";
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
                <button id="create">Crear Periodo</button>
            </div>

            <table class="table">
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

                        $actionStatus = $period['validity'] != 2 ? "Modificar": "Ver";

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
    </div>
    <script src="../../assets/js/gestionarPeriodos/listarPeriodos.js"></script>
</body>

</html>