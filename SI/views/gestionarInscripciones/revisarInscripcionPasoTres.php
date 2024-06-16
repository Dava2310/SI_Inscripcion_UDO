<?php
$_title = "Solicitar Inscripción";
include('../../controllers/clases/inscripcion.php');
include('../../controllers/clases/estudiante.php');
include('../../controllers/clases/carrera.php');
include_once('../../views/templates/encabezadoConfig.php');

session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: ../login.php');
    exit;
}

$inscriptionId = $_GET['id'];
$inscriptionObject = new Inscription();
$inscriptionsDetails = $inscriptionObject->getInscriptionByID($inscriptionId);
$url = $inscriptionsDetails['url'];

$licenseIdUpload = '/assets/fs/' . $url . 'licenseID.png';
$birthCertificate = '/assets/fs/' . $url . 'birthCertificate.png';
$degree = '/assets/fs/' . $url . 'degree.png';
$letter = '/assets/fs/' . $url . 'letter.png';
$notes = '/assets/fs/' . $url . 'notes.png';
$spreadsheet = '/assets/fs/' . $url . 'spreadsheet.png';


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
        } else {
            echo "<script>
                window.alert('No esta en esta fase de la inscripcion');
                window.location.href='../gestionarInscripciones/listarInscripciones.php';
              </script>";
        }
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="../../assets/css/filesUpload.css" />
</head>

<body>
    <div class="content">
        <div class="form-inscription-documents">
            <form id="form" method="post" action="../../controllers/gestionarInscripciones/revisarInscripcionPasoTres.php?id=<?= $inscriptionId ?>" enctype="multipart/form-data">
                <h1 class="formHeader">Documentos Recaudados</h1>

                <div class="documents">
                    <div>
                        <label for="licenseIdUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Cédula</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $licenseIdUpload; ?>">Ver</button>

                            </div>
                        </label>
                        <input id="licenseIdUpload" type="file" class="formInput" name="licenseID" data-url="<?php echo $licenseIdUpload; ?>" hidden />
                    </div>

                    <div>
                        <label for="notesUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Notas Certificadas</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $notes; ?>">Ver</button>

                            </div>
                        </label>
                        <input id="notesUpload" type="file" class="formInput" name="notes" data-url="<?php echo $notes; ?>" hidden />
                    </div>

                    <div>
                        <label for="degreeUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Título de Bachiller</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $degree; ?>">Ver</button>
                            </div>
                        </label>
                        <input id="degreeUpload" type="file" class="formInput" name="degree" data-url="<?php echo $degree; ?>" hidden />
                    </div>

                    <div>
                        <label for="birthCertificateUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Partida de Nacimiento</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $birthCertificate; ?>">Ver</button>

                            </div>
                        </label>
                        <input id="birthCertificateUpload" type="file" class="formInput" name="birthCertificate" data-url="<?php echo $birthCertificate; ?>" hidden />
                    </div>
                    <div id="planilla">
                        <label for="spreadsheetOpsuUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Planilla OPSU</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $spreadsheet; ?>">Ver</button>

                            </div>
                        </label>
                        <input id="spreadsheetOpsuUpload" type="file" class="formInput" name="spreadsheet" data-url="<?php echo $spreadsheet; ?>" hidden />
                    </div>
                    <div id="carta">
                        <label for="letterUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Carta</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload" data-url="<?php echo $letter; ?>">Ver</button>
                            </div>
                        </label>
                        <input id="letterUpload" type="file" class="formInput" name="letter" data-url="<?php echo $letter; ?>" hidden />
                    </div>

                </div>


                <!-- Aprobar o Rechazar -->
                <div class="decisionDiv">
                    <label for="decision">Decision</label><br />
                    <select name="decision" id="decision" required>
                        <option value="">Seleccione la decisión</option>
                        <option value="approve">Aprobar</option>
                        <option value="reject">Rechazar</option>
                    </select>
                </div>

                <div class="observations" id="observations" style="display: none;">
                    <label for="observation">Observaciones</label><br />
                    <textarea class="observation" id="observation" name="observation" placeholder="Escriba aquí la razón del rechazo"></textarea>
                </div>

                <!-- Enviar -->
                <button type="submit" class="formButton">Enviar</button>
            </form>
        </div>
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