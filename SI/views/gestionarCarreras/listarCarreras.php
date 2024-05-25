<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/carrera.php');

// Crear una instancia de la clase Student
$career = new Career();

// Obtener la lista de estudiantes
$careers = $career->getCareers();
?>

<?php
$title = "Carreras";
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
                <button id="create">Crear Carrera</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer la lista de estudiantes y mostrar su información en filas de la tabla
                    foreach ($careers as $career) {
                        echo <<<HTML
                        <tr class="dataList">
                            <td>{$career['name']}</td>
                            <td>{$career['description']}</td>
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