<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/inscripciones.php');

// Crear una instancia de la clase Inscription
$inscription = new Inscription();

// Obtener datos de la inscripccion
$inscriptionId = $_GET['id'];
$inscription = $inscription->getInscriptionByID($inscriptionId);
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
        <div class="form-inscription">
            <form action="../../controllers/gestionarInscripciones/crearInscripciones.php?id=<?= $studentID ?>" method="post" enctype="multipart/form-data">
                <label for="process" class="formLabel">Selecciona tu proceso de Inscripción:</label>
                <select id="process" name="process" class="formSelect" disabled>
                    <option value="">Seleccionada: <?=$inscription['process']?></option>
                </select>

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
                        <input id="licenseIdUpload" type="file" class="formInput" name="licenseID"/>
                    </div>

                    <div>
                        <label for="notesUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Notas Certificadas</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUploadd">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="notesUpload" type="file" class="formInput" name="notes" />
                    </div>

                    <div>
                        <label for="degreeUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Título de Bachiller</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="degreeUpload" type="file" class="formInput" name="degree" />
                    </div>

                    <div>
                        <label for="birthCertificate" class="customFileUpload">
                            <p class="fileTitle">Subir Partida de Nacimiento</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="birthCertificate" type="file" class="formInput" name="birthCertificate" />
                    </div>
                    <div id="planilla">
                        <label for="spreadsheetOpsuUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Planilla OPSU</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="spreadsheetOpsuUpload" type="file" class="formInput" name="spreadsheet" />
                    </div>
                    <div id="carta">
                        <label for="letterUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Carta</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="letterUpload" type="file" class="formInput" name="letter" />
                    </div>

                </div>
                <div>
                    <h2>Observacion</h2>
                    <textarea disabled class="description" name="description" placeholder="Escribe una observacion para enviar a control de estudios"><?=$inscription['description']?></textarea>
                </div>

                <button type="submit" class="formButton">Enviar</button>
                <button type="button" class="formButton">Deshacer todo</button>
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
</body>

</html>