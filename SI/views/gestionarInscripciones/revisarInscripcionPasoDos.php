<?php
session_start();
$_title = "Revision Inscripción";
include ('../templates/head.php');

// Obtener todos los datos del estudiante e inscripcion
include_once ('../../controllers/clases/inscripcion.php');
include_once ('../../controllers/clases/carreraSeleccionada.php');

// Inicio de la sesion

$userID = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no hay estudiante registrado
if (!(isset($userID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}



// Inscripciones
$inscriptionId = $_GET['id'];
$inscriptionObject = new Inscription();
$inscriptionDetails = $inscriptionObject->getInscriptionByID($inscriptionId);

// Carreras seleccionadas
$selectedCareerObject = new SelectedCareer();
$selectedCareers = $selectedCareerObject->getSelectedCareersByInscriptionID($inscriptionId);

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
                <h1>Revision de la Solicitud</h1>

                <form id="form"
                    action="../../controllers/gestionarInscripciones/revisarInscripcionPasoDos.php?id=<?= $inscriptionId ?>"
                    method="post">

                    <div class="form-grid_container">

                        <!-- Codigo Opsu -->
                        <div class="form-group_control">
                            <label for="opsuCode">Codigo de Opsu</label>
                            <input class="form-input"  type="text" name="opsuCode" required disabled
                                value="<?= $inscriptionDetails['opsuCode'] ?>" />
                        </div>

                        <!-- Codigo Titulo -->
                        <div class="form-group_control">
                            <label for="degreeCode">Codigo de título</label>
                            <input class="form-input" type="text" name="degreeCode" required disabled
                                value="<?= $inscriptionDetails['degreeCode'] ?>" />
                        </div>
                        <!-- Direccion Plantel -->
                        <div class="form-group_control">
                            <label for="campusAddress">Direccion Plantel</label>
                            <input class="form-input" type="text" name="campusAddress" required disabled
                                value="<?= $inscriptionDetails['campusAddress'] ?>" />
                        </div>
                        <!-- Año Graduacion -->
                        <div class="form-group_control">
                            <label for="graduationYear">Año de graduación</label>
                            <input class="form-input" type="date" name="graduationYear" required disabled
                                value="<?= $inscriptionDetails['graduationYear'] ?>" />
                        </div>
                        <!-- Nombre Titulo -->
                        <div class="form-group_control">
                            <label for="degreeTitle">Nombre del título</label>
                            <input class="form-input" type="text" name="degreeTitle" required disabled
                                value="<?= $inscriptionDetails['degreeTitle'] ?>" />
                        </div>
                        <!-- Promedio -->
                        <div class="form-group_control">
                            <label for="gradePointAverage">Promedio</label>
                            <input class="form-input" type="number" name="gradePointAverage" placeholder="0.000" required disabled
                                value="<?= $inscriptionDetails['gradePointAverage'] ?>" />
                        </div>

                        <!-- Proceso de Inscripcion -->
                        <div class="form-group_control">
                            <label for="inscriptionProcess">Proceso de Inscripción</label>
                            <select class="form-input" name="inscriptionProcess" id="inscriptionProcess" required disabled>
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
                        <?php foreach ($selectedCareers as $career): ?>
                            <div id="singleCareerSelection" class="form-group_control">
                                <label for="singleCareer<?= $career['ID'] ?>">Carrera</label>
                                <select class="form-input" id="singleCareer<?= $career['ID'] ?>" required disabled>
                                    <option value="<?= $career['name'] ?>"><?= $career['name'] ?></option>
                                </select>
                            </div>
                        <?php endforeach; ?>

                        <!-- Aprobar o Rechazar -->
                        <div class="form-group_control">
                            <label for="decision">Decision</label>
                            <select class="form-input" name="decision" id="decision" required>
                                <option value="">Seleccione la decisión</option>
                                <option value="approve">Aprobar</option>
                                <option value="reject">Rechazar</option>
                            </select>
                        </div>

                        <div id="observations" style="display: none;" class="form-group_control">
                            <label for="observation">Observaciones</label>
                            <textarea class="observation form-textArea" id="observation" name="observation"
                                placeholder="Escriba aquí la razón del rechazo"></textarea>
                        </div>
                        <!-- Enviar -->
                        <button type="submit" class="formButton">Enviar</button>
                    </div>

                </form>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/gestionarInscripciones/revisarInscripcionPasoDos.js"></script>
</body>

</html>