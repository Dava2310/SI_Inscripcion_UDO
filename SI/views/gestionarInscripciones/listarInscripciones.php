<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/inscripciones.php');

session_start();

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
                        <th>Fecha de Registro</th>
                        <th>Estado</th>
                        <th>Proceso</th>
                        <th>Fase de Inscripccion</th>
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
                        $file; 
                        $phase;

                        $name = $inscription['studentName'];
                        $lastName = $inscription['lastName'];
                        $licenseId = $inscription['licenseID'];
                        $email = $inscription['email'];
                        $date = $inscription['date'];
                        $state = $inscription['state'];
                        $process = $inscription['process'] ?? "Ninguno";

                        if ($inscription['inscriptionPhase'] == 1) {
                            $file = "consultarInscripcionPasoUno.php?id={$inscription['ID']}";
                            $phase = "Primera";
                        } else if ($inscription['inscriptionPhase'] == 2) {
                            $file = "consultarInscripcionPasoDos.php?id={$inscription['ID']}";
                            $phase = "Segunda";
                        } else {
                            $file = "consultarInscripcionPasoTres.php?id={$inscription['ID']}";
                            $phase = "Tercera";
                        }

                        echo <<<HTML
                        <tr class="dataList">
                            <td>$name</td>
                            <td>$lastName</td>
                            <td>$licenseId</td>
                            <td>$email</td>
                            <td>$date</td>
                            <td>$state</td>
                            <td>$process</td>
                            <td>$phase</td>
                            <td><a href=$file>revisar</a></td>
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