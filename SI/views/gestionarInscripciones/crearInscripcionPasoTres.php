<?php
$title = "Solicitar Inscripción";
include('../../controllers/clases/inscripcion.php');
include('../../controllers/clases/estudiante.php');
include('../../controllers/clases/carrera.php');

session_start();

if (!isset($_SESSION['ID'])) {
    header('Location: ../login.php');
    exit;
}

$studentId = $_SESSION['ID'];

try {
    $inscription = new Inscription();
    $inscriptionDetails = $inscription->getInscriptionByStudentId($studentId);

    if ($inscriptionDetails['inscriptionPhase'] === 3) {
        if ($inscriptionDetails['state'] === "En Revision") {
            echo "<script>
                    window.alert('Esta en revision, espere');
                    window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
                </script>";
            exit;
        } else if ($inscriptionDetails['state'] === "Aprobado") {
            echo "<script>
                    window.alert('Usted ya ha sido aprobado');
                    window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
                </script>";
            exit;
        }
    } else {
        echo "<script>
            window.alert('No esta en esta fase de la inscripcion');
            window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
          </script>";
        exit;
    }
} catch (Exception $e) {
    echo "<script>
            window.alert('Ocurrió un error al procesar la solicitud: " . $e->getMessage() . "');
            window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
          </script>";
    exit;
}
?>

<html>

<head>
    <link rel="stylesheet" href="../../assets/css/filesUpload.css" />
</head>

<body>
    <div class="content">
        <div class="form-inscription-documents">
            <form id="form" method="post" action="../../controllers/gestionarInscripciones/crearInscripcionPasoTres.php" enctype="multipart/form-data">
                <h1 class="formHeader">Documentos Recaudados</h1>

                <div class="documents">
                    <div>
                        <label for="licenseIdUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Cédula</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="licenseIdUpload" type="file" class="formInput" name="licenseID" hidden />
                    </div>

                    <div>
                        <label for="notesUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Notas Certificadas</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUploadd">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="notesUpload" type="file" class="formInput" name="notes" hidden />
                    </div>

                    <div>
                        <label for="degreeUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Título de Bachiller</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="degreeUpload" type="file" class="formInput" name="degree" hidden />
                    </div>

                    <div>
                        <label for="birthCertificate" class="customFileUpload">
                            <p class="fileTitle">Subir Partida de Nacimiento</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="birthCertificate" type="file" class="formInput" name="birthCertificate" hidden />
                    </div>
                    <div id="planilla">
                        <label for="spreadsheetOpsuUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Planilla OPSU</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="spreadsheetOpsuUpload" type="file" class="formInput" name="spreadsheet" hidden />
                    </div>
                    <div id="carta">
                        <label for="letterUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Carta</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="letterUpload" type="file" class="formInput" name="letter" hidden />
                    </div>

                </div>
                <div class="buttonActions">
                    <button type="submit">Enviar</button>
                    <button type="button">Deshacer todo</button>
                </div>

            </form>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modalContent">
            <object class="fileContent" id="fileContent" type="application/pdf">

            </object>
        </div>
        <button class="modalClose" id="modalClose">Cerrar</button>
    </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoTres.js"></script>
</body>

</html>