<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/inscripciones.php');

// Crear una instancia de la clase Student
$inscription = new Inscription();

// Obtener la lista de estudiantes
$inscriptions = $inscription->getInscriptions();
?>

<?php
$title = "Panel De Inscripciones";
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
            </div>


            <table class="table">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Cedula</th>
                        <th>Correo</th>
                        <th>Fecha de Inscripccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer la lista de estudiantes y mostrar su información en filas de la tabla
                    if (!($inscriptions)) {
                        return;
                    }

                    foreach ($inscriptions as $inscription) {
                        echo <<<HTML
                        <tr class="dataList">
                            <td>{$inscription['studentName']}</td>
                            <td>{$inscription['lastName']}</td>
                            <td>{$inscription['licenseID']}</td>
                            <td>{$inscription['email']}</td>
                            <td>{$inscription['date']}</td>
                            <td><a href="consultarInscripcion.php?id={$inscription['ID']}">revisar</a></td>
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