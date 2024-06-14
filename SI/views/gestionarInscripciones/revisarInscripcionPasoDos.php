<?php
// Obtener todos los datos del estudiante e inscripcion
include_once('../../controllers/clases/inscripcion.php');
include_once('../../controllers/clases/carreraSeleccionada.php');

// Inscripciones
$inscriptionId = $_GET['id'];
$inscriptionObject = new Inscription();
$inscriptionDetails = $inscriptionObject->getInscriptionByID($inscriptionId);

// Carreras seleccionadas
$selectedCareerObject = new SelectedCareer();
$selectedCareers = $selectedCareerObject->getSelectedCareersByInscriptionID($inscriptionId);


?>

<?php
$_title = "Revision Inscripción";
include('../templates/encabezadoConfig.php');
?>

<body>
    <div class="content">
        <div class="form-inscription">
            <form id="form" action="../../controllers/gestionarInscripciones/revisarInscripcionPasoDos.php?id=<?=$inscriptionId?>" method="post">
                <div>
                    <h2>Revision</h2>
                </div>

                <!-- Codigo Opsu -->
                <div>
                    <label for="opsuCode">Codigo de Opsu</label>
                    <input type="text" name="opsuCode" required disabled value="<?= $inscriptionDetails['opsuCode'] ?>" />
                </div>

                <!-- Codigo Titulo -->
                <div>
                    <label for="degreeCode">Codigo de título</label>
                    <input type="text" name="degreeCode" required disabled value="<?= $inscriptionDetails['degreeCode'] ?>" />
                </div>

                <!-- Direccion Plantel -->
                <div>
                    <label for="campusAddress">Direccion Plantel</label>
                    <input type="text" name="campusAddress" required disabled value="<?= $inscriptionDetails['campusAddress'] ?>" />
                </div>

                <!-- Año Graduacion -->
                <div>
                    <label for="graduationYear">Año de graduación</label>
                    <input type="date" name="graduationYear" required disabled value="<?= $inscriptionDetails['graduationYear'] ?>" />
                </div>

                <!-- Nombre Titulo -->
                <div>
                    <label for="degreeTitle">Nombre del título</label>
                    <input type="text" name="degreeTitle" required disabled value="<?= $inscriptionDetails['degreeTitle'] ?>" />
                </div>

                <!-- Promedio -->
                <div>
                    <label for="gradePointAverage">Promedio</label>
                    <input type="number" name="gradePointAverage" placeholder="0.000" required disabled value="<?= $inscriptionDetails['gradePointAverage'] ?>" />
                </div>

                <!-- Proceso de Inscripcion -->
                <div>
                    <label for="inscriptionProcess">Proceso de Inscripción</label>
                    <select name="inscriptionProcess" id="inscriptionProcess" required disabled>
                        <option value="<?= $inscriptionDetails['idProcess'] ?>">
                            <?php
                            if ($inscriptionDetails['idProcess'] == 1) {
                                echo "Opsu";
                            } elseif ($inscriptionDetails['idProcess'] == 2) {
                                echo "RUSI";
                            } else {
                                echo "Convenio";
                            }
                            ?>
                        </option>
                    </select>
                </div>

                <!-- Carreras Seleccionadas -->
                <?php foreach ($selectedCareers as $career) : ?>
                    <div id="singleCareerSelection">
                        <label for="singleCareer<?= $career['ID'] ?>">Carrera</label>
                        <select id="singleCareer<?= $career['ID'] ?>" required disabled>
                            <option value="<?= $career['name'] ?>"><?= $career['name'] ?></option>
                        </select>
                    </div>
                <?php endforeach; ?>

                <!-- Aprobar o Rechazar -->
                <div>
                    <label for="decision">Decision</label>
                    <select name="decision" id="decision" required>
                        <option value="">Seleccione la decisión</option>
                        <option value="approve">Aprobar</option>
                        <option value="reject">Rechazar</option>
                    </select>
                </div>

                <div id="observations" style="display: none;">
                    <label for="observation">Observaciones</label>
                    <textarea  class="observation" id="observation" name="observation" placeholder="Escriba aquí la razón del rechazo"></textarea>
                </div>

                <!-- Enviar -->
                <button type="submit" class="formButton">Enviar</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/revisarInscripcionPasoDos.js"></script>
</body>

</html>
