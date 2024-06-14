<?php
// Incluir el archivo con la definición de la clase Inscription
include_once('../../controllers/clases/inscripcion.php');

session_start();

// Crear una instancia de la clase Inscription
$inscription = new Inscription();

// Obtener la lista de inscripciones
$inscriptions = $inscription->getInscriptions();
?>

<?php
$title = "Panel De Inscripciones";
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
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Fecha de Registro</th>
                        <th>Estado</th>
                        <th>Proceso</th>
                        <th>Fase de Inscripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer la lista de inscripciones y mostrar su información en filas de la tabla
                    if (!($inscriptions)) {
                        return;
                    }

                    foreach ($inscriptions as $inscription) {
                        $file; 
                        $phase;

                        if ($inscription['inscriptionPhase'] === 0 || $inscription['inscriptionPhase'] === 1 ){
                            continue;
                        }

                        $name = $inscription['name'];
                        $lastName = $inscription['lastName'];
                        $licenseId = $inscription['licenseID'];
                        $email = $inscription['email'];
                        $date = $inscription['date'];
                        $state = $inscription['state'] == '' ? "Ninguno": $inscription['state'];
                        $process = $inscription['process'] ?? "Ninguno";

                        if ($inscription['inscriptionPhase'] === 1) {
                            $phase = "Primera";
                        } else if ($inscription['inscriptionPhase'] === 2) {
                            $phase = "Segunda";
                        } else if ($inscription['inscriptionPhase'] === 3) {
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
                            <td><a href="revisarInscripcionPasoDos.php?id={$inscription['ID']}">Revisar</a></td>
                        </tr>
                        HTML;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/listarInscripciones.js"></script>
</body>

</html>
