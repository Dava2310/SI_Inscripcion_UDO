<?php
session_start();
$_title = "Revision Inscripcion";
include ('../templates/headFiles.php');

include ('../../controllers/clases/inscripcion.php');
include ('../../controllers/clases/estudiante.php');
include ('../../controllers/clases/carrera.php');

// Inicio de la sesion

$userID = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no hay estudiante registrado
if (!(isset($userID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

$inscriptionId = $_GET['id'];
$inscriptionObject = new Inscription();
$inscriptionsDetails = $inscriptionObject->getInscriptionByID($inscriptionId);
$url = $inscriptionsDetails['url'];

function getFilePath($basePath, $filename) {
    $extensions = ['png', 'jpg', 'jpeg', 'pdf'];
    foreach ($extensions as $ext) {
        $fullPath = $basePath . $filename . '.' . $ext;
        if (file_exists($fullPath)) {
            return $fullPath;
        }
    }
    return null;
}

$licenseIdUpload = getFilePath('../../assets/fs/' . $url, 'licenseID');
$birthCertificate = getFilePath('../../assets/fs/' . $url, 'birthCertificate');
$degree = getFilePath('../../assets/fs/' . $url, 'degree');
$letter = getFilePath('../../assets/fs/' . $url, 'letter');
$notes = getFilePath('../../assets/fs/' . $url, 'notes');
$spreadsheet = getFilePath('../../assets/fs/' . $url, 'spreadsheet');


if ($inscriptionsDetails) {
    if ($inscriptionsDetails['inscriptionPhase'] === 3) {
        if ($inscriptionsDetails['state'] === "Aprobado") {
            echo "<script>
                window.alert('Ya ha sido aprobado este estudiante');
                window.location.href='../gestionarInscripciones/listarInscripciones.php';
              </script>";
            exit;
        } else if ($inscriptionsDetails['state'] === "A Corregir") {
            echo "<script>
                window.alert('Espere a que el estudiante corrija sus documentos');
                window.location.href='../gestionarInscripciones/listarInscripciones.php';
              </script>";
            exit;
        }
    }
} else {
    echo "<script>
                window.alert('Hubo un error');
                window.location.href='../gestionarInscripciones/listarInscripciones.php';
              </script>";
}
?>

<body>

    <div class="main-container">
        <?php

        if ($idRole === 1) {
            include ('../templates/menus/menuAdministrador.php');
        } else {
            include ('../templates/menus/menuEmpleado.php');
        }
        ?>

        <main>
            <div class="info-container">
                <h1>Revision de la Inscripcion: Documentos</h1>

                <form id="form" method="post"
                    action="../../controllers/gestionarInscripciones/revisarInscripcionPasoTres.php"
                    enctype="multipart/form-data">

                    <input hidden name="ID" value="<?=$inscriptionId?>" type="text">

                    <div class="documents">
                        <div>
                            <label for="licenseIdUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Cédula</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $licenseIdUpload; ?>">Ver</button>

                                </div>
                            </label>
                            <input id="licenseIdUpload" type="file" class="formInput" name="licenseID"
                                data-url="<?php echo $licenseIdUpload; ?>" hidden />
                        </div>

                        <div>
                            <label for="notesUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Notas Certificadas</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $notes; ?>">Ver</button>

                                </div>
                            </label>
                            <input id="notesUpload" type="file" class="formInput" name="notes"
                                data-url="<?php echo $notes; ?>" hidden />
                        </div>

                        <div>
                            <label for="degreeUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Título de Bachiller</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $degree; ?>">Ver</button>
                                </div>
                            </label>
                            <input id="degreeUpload" type="file" class="formInput" name="degree"
                                data-url="<?php echo $degree; ?>" hidden />
                        </div>

                        <div>
                            <label for="birthCertificateUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Partida de Nacimiento</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $birthCertificate; ?>">Ver</button>

                                </div>
                            </label>
                            <input id="birthCertificateUpload" type="file" class="formInput" name="birthCertificate"
                                data-url="<?php echo $birthCertificate; ?>" hidden />
                        </div>

                        <div id="planilla">
                            <label for="spreadsheetOpsuUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Planilla OPSU</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $spreadsheet; ?>">Ver</button>

                                </div>
                            </label>
                            <input id="spreadsheetOpsuUpload" type="file" class="formInput" name="spreadsheet"
                                data-url="<?php echo $spreadsheet; ?>" hidden />
                        </div>

                        <div id="carta">
                            <label for="letterUpload" class="customFileUpload">
                                <p class="fileTitle">Subir Carta</p>
                                <div class="fileOptions">
                                    <button type="button" class="seeFileUpload"
                                        data-url="<?php echo $letter; ?>">Ver</button>
                                </div>
                            </label>
                            <input id="letterUpload" type="file" class="formInput" name="letter"
                                data-url="<?php echo $letter; ?>" hidden />
                        </div>
                    </div>

                    <!-- Aprobar o Rechazar -->
                    <div class="decisionDiv">
                        <label for="decision">Decision</label><br />
                        <select class="form-input" name="decision" id="decision" required>
                            <option value="">Seleccione la decisión</option>
                            <option value="approve">Aprobar</option>
                            <option value="reject">Rechazar</option>
                        </select>
                    </div>

                    <div class="observations" id="observations" style="display: none;">
                        <label for="observation">Observaciones</label><br />
                        <textarea class="observation" id="observation" name="observation"
                            placeholder="Escriba aquí la razón del rechazo"></textarea>
                    </div>

                    <div class="buttonActions">
                        <!-- Enviar -->
                        <button type="submit" class="formButton">Enviar</button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <div id="modal" class="modal">
        <div class="modalContent">
            <iframe class="fileContent" id="fileContent" type="application/pdf"></iframe>
        </div>
        <button class="modalClose" id="modalClose">Cerrar</button>
    </div>
    <script src="../../assets/js/gestionarInscripciones/revisarInscripcionPasoTres.js"></script>
</body>
</html>