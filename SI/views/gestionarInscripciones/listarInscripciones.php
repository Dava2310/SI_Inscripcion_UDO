<?php

$_title = "Gestion de Inscripciones";
include ('../templates/head.php');

// Inicio de la sesion
session_start();
$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Incluir el archivo con la definición de la clase Inscription
include_once ('../../controllers/clases/inscripcion.php');

// Crear una instancia de la clase Inscription
$inscription = new Inscription();

// Obtener la lista de inscripciones
$inscriptions = $inscription->getInscriptions();
?>


<body>

    <div class="main-container">
        <!-- CONTENIDO DEL MENU DE NAVEGACION -->
        <?php
        if ($idRole === 1) {
            include ('../templates/menus/menuAdministrador.php');
        } else {
            include ('../templates/menus/menuEmpleado.php');
        }

        ?>

        <main>
            <div class="info-container">
                <h1>Busque la Solicitud</h1>

                <form action="">
                    <div class="search_container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>
                </form>

                <h1>Lista de Solicitudes</h1>
                <div class="tabla-container">
                    <table>
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

                            $condicion = true;

                            foreach ($inscriptions as $inscription) {
                                $file;
                                $phase;

                                if ($inscription['inscriptionPhase'] === 0 || $inscription['inscriptionPhase'] === 1) {
                                    continue;
                                }

                                $name = $inscription['name'];
                                $lastName = $inscription['lastName'];
                                $licenseId = $inscription['licenseID'];
                                $email = $inscription['email'];
                                $date = $inscription['date'];
                                $state = $inscription['state'] == '' ? "Ninguno" : $inscription['state'];
                                $process = $inscription['process'] ?? "Ninguno";

                                if ($inscription['inscriptionPhase'] === 1) {
                                    $phase = "Primera";
                                } else if ($inscription['inscriptionPhase'] === 2) {
                                    $phase = "Segunda";
                                } else if ($inscription['inscriptionPhase'] === 3) {
                                    $phase = "Tercera";
                                }

                                if ($inscription['state'] === 'A Corregir' || $inscription['state'] === '') {
                                    $condicion = false;
                                } else {

                                    // Determinar el enlace correcto para la revisión
                                    $reviewLink = "revisarInscripcionPasoDos.php?id={$inscription['ID']}";

                                    if ($inscription['inscriptionPhase'] === 3 && $inscription['state'] === 'En Revision') {
                                        $reviewLink = "revisarInscripcionPasoTres.php?id={$inscription['ID']}";
                                    }
                                    
                                    $condicion = true;
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
                        HTML;

                                if ($condicion) {
                                    echo <<<HTML
                                    <td><a href="$reviewLink">Revisar</a></td>
                                HTML;
                                } else {
                                    echo <<<HTML
                                    <td>Ninguna</td>
                                HTML;
                                }
                                echo <<<HTML
                        </tr>
                        HTML;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarInscripciones/listarInscripciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>