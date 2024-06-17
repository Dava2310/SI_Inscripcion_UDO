<?php

$_title = "Solicitar Inscripción - Asignar Carrera";
include ('./../templates/head.php');
include ('../../controllers/clases/inscripcion.php');
include ('../../controllers/clases/estudiante.php');
include ('../../controllers/clases/carrera.php'); // Incluimos la clase de Carrera

// Inicio de la sesion
session_start();
$studentID = $_SESSION['ID'];

// Si no hay estudiante registrado
if (!(isset($studentID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

try {
    // Buscar inscripción por ID del estudiante
    $inscription = new Inscription();
    $inscriptionDetails = $inscription->getInscriptionByStudentId($studentID);

    if (!$inscriptionDetails) {
        $message = 'Usted no tiene una Solicitud de Inscripcion';
    } else {
        // Comprobar la fase y el estado de la inscripción
        switch ($inscriptionDetails['inscriptionPhase']) {
            case 1:
                break;
            case 2:
                if ($inscriptionDetails['state'] === 'En Revision') {
                    $message = 'Esta fase está en revisión, espere';
                } else {
                    $message = 'No está en esta fase de la inscripción';
                }
                break;
            default:
                $message = 'No está en esta fase de la inscripción';
                break;
        }
    }

    // Si hay un mensaje, mostrar alerta y redirigir
    if (isset($message)) {
        echo "<script>
                window.alert('$message');
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

// Creamos una instancia de la clase Career
$career = new Career();
$careers = $career->getCareers();
?>

<body>

    <div class="main-container">
        <!-- MENU DE NAVEGACION -->
        <?php
        include ("./../templates/menus/menuEstudiante.php");
        ?>

        <main>
            <div class="info-container">
                <h1>Paso 2 de 3: Seleccion de la Carrera(s)</h1>

                <form id="form" action="../../controllers/gestionarInscripciones/crearInscripcionPasoDos.php"
                    method="post">

                    <div class="form-grid_container">

                        <!-- Proceso de Inscripcion -->
                        <div class="form-group_control">
                            <label for="inscriptionProcess">Proceso de Inscripción</label>
                            <select class="form-input" name="inscriptionProcess" id="inscriptionProcess" required
                                onchange="showCareers()">
                                <option value="">Ingresa tu metodo de Inscripcion</option>
                                <option value="1">OPSU</option>
                                <option value="2">RUSI</option>
                                <option value="3">CONVENIO</option>
                            </select>
                        </div>

                        <!-- Selects para Carreras (RUSI) -->
                        <div id="careersSelection" style="display: none;">
                            <!-- Select 1 -->
                            <div class="form-group_control">
                                <label for="career1">Carrera 1</label>
                                <select class="form-input" name="career1" id="career1" required>
                                    <option value="">Ingresa tu carrera</option>
                                    <?php foreach ($careers as $career): ?>
                                        <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Select 2 -->
                            <div class="form-group_control">
                                <label for="career2">Carrera 2</label>
                                <select class="form-input" name="career2" id="career2" required>
                                    <option value="">Ingresa tu carrera</option>
                                    <?php foreach ($careers as $career): ?>
                                        <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Select 3 -->
                            <div class="form-group_control">
                                <label for="career3">Carrera 3</label>
                                <select class="form-input" name="career3" id="career3" required>
                                    <option value="">Ingresa tu carrera</option>
                                    <?php foreach ($careers as $career): ?>
                                        <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Select para Carrera (OPSU y CONVENIO) -->
                        <div id="singleCareerSelection" class="form-group_control">
                            <label for="singleCareer">Carrera</label>
                            <select class="form-input" name="singleCareer" id="singleCareer" required>
                                <option value="">Ingresa tu carrera</option>
                                <?php foreach ($careers as $career): ?>
                                    <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="group_buttons">
                            <!-- Enviar -->
                            <button type="submit" class="formButton">Enviar</button>

                            <!-- Deshacer -->
                            <button type="button" class="formButton">Deshacer todo</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoDos.js"></script>
</body>

</html>
