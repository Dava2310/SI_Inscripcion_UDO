<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/estudiante.php');
session_start();

// Take StudentID and get data
$studentID = $_SESSION['ID'];

$student = new Student();
$studentDetails = $student->getStudentByID($studentID);
?>

<?php
$title = "Crear Inscripcion";
include('./../templates/encabezadoConfig.php');
?>

<body>
    <?php include("./../templates/menus/menuEstudiante.php") ?>
    <div class="content">
        <div class="form-inscription">
            <form action="../../controllers/gestionarInscripciones/crearInscripciones.php?id=<?=$studentID?>" method="post" enctype="multipart/form-data">
                <label for="process" class="formLabel">Selecciona tu proceso de Inscripción:</label>
                <select id="process" name="process" class="formSelect">
                    <option value="">Selecciona una opcion</option>
                    <option value="1">OPSU</option>
                    <option value="2">RUSI</option>
                    <option value="3">Convenio</option>
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
                        <input id="notesUpload" type="file" class="formInput" name="notes"/>
                    </div>

                    <div>
                        <label for="degreeUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Título de Bachiller</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="degreeUpload" type="file" class="formInput" name="degree"/>
                    </div>

                    <div>
                        <label for="birthCertificate" class="customFileUpload">
                            <p class="fileTitle">Subir Partida de Nacimiento</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="birthCertificate" type="file" class="formInput" name="birthCertificate"/>
                    </div>
                    <div id="planilla">
                        <label for="spreadsheetOpsuUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Planilla OPSU</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="spreadsheetOpsuUpload" type="file" class="formInput" name="spreadsheet"/>
                    </div>
                    <div id="carta">
                        <label for="letterUpload" class="customFileUpload">
                            <p class="fileTitle">Subir Carta</p>
                            <div class="fileOptions">
                                <button type="button" class="seeFileUpload">Ver</button>
                                <button type="button" class="removeFileUpload">Eliminar</button>
                            </div>
                        </label>
                        <input id="letterUpload" type="file" class="formInput" name="letter"/>
                    </div>

                </div>
                <div>
                    <h2>Observacion</h2>
                    <textarea class="description" name="description" placeholder="Escribe una observacion para enviar a control de estudios"></textarea>
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

    <script src="../../assets/js/gestionarInscripciones/crearInscripcion.js"></script>
</body>

</html>