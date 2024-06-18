<?php
session_start();
$_title = "Solicitar Inscripción - Datos Basicos";
include ('./../templates/head.php');
include ('../../controllers/clases/inscripcion.php');
include ('../../controllers/clases/estudiante.php');
include ('../../controllers/clases/carrera.php');
include ('../../controllers/clases/periodo.php');

// Inicio de la sesion
$studentID = $_SESSION['ID'];

$periodObject = new Period();
$period = $periodObject->getCurrentPeriod();

if (!$period['validity'] && $period['validity'] !== 1) {
    echo "<script> window.alert('No ha empezado ningun periodo');</script>";
    echo "<script> window.location='../dashboardEstudiantes/dashboardEstudiantes.php'; </script>";
    die(); 
}

// Si no hay estudiante registrado
if (!(isset($studentID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Obtener datos de la inscripción
$studentId = $_SESSION['ID'];

try {
    // Buscar inscripción por ID del estudiante
    $inscription = new Inscription();
    $inscriptionDetails = $inscription->getInscriptionByStudentId($studentId);

    // Verificar si no existe ninguna inscripción activa o si la fase es 2 y no tiene un estado de "A Corregir"
    if ($inscriptionDetails) {
        if ($inscriptionDetails['inscriptionPhase'] !== 2 || $inscriptionDetails['state'] !== "A Corregir") {
            echo "<script>
                    window.alert('No está en esta fase de la inscripción');
                    window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
                  </script>";
            exit;
        }
    }
} catch (Exception $e) {
    echo "<script>
            window.alert('Ocurrió un error al procesar la solicitud: " . $e->getMessage() . "');
            window.location.href='../dashboardEstudiantes/dashboardEstudiantes.php';
          </script>";
    exit;
}

?>

<body>

    <div class="main-container">
        <!-- MENU DE NAVEGACION -->
        <?php
        include ("./../templates/menus/menuEstudiante.php");
        ?>

        <main>
            <div class="info-container">
                <h1>Paso 1 de 3: Datos Básicos de la Solicitud</h1>

                <form id="form" action="../../controllers/gestionarInscripciones/crearInscripcionPasoUno.php"
                    method="post">

                    <div class="form-grid_container">

                        <!-- Codigo Opsu -->
                        <div class="form-group_control">
                            <label for="opsuCode">Codigo de Opsu</label>
                            <input class="form-input" type="text" name="opsuCode" value="<?= isset($inscriptionDetails['opsuCode']) ? htmlspecialchars($inscriptionDetails['opsuCode']) : '' ?>" required />
                        </div>

                        <!-- Codigo Titulo -->
                        <div class="form-group_control">
                            <label for="degreeCode">Codigo de título</label>
                            <input class="form-input" type="text" name="degreeCode" value="<?= isset($inscriptionDetails['degreeCode']) ? htmlspecialchars($inscriptionDetails['degreeCode']) : '' ?>" required />
                        </div>

                        <!-- Direccion Plantel -->
                        <div class="form-group_control">
                            <label for="campusAddress">Direccion Plantel</label>
                            <input class="form-input" type="text" name="campusAddress" value="<?= isset($inscriptionDetails['campusAddress']) ? htmlspecialchars($inscriptionDetails['campusAddress']) : '' ?>" required />
                        </div>

                        <!-- Año Graduacion -->
                        <div class="form-group_control">
                            <label for="graduationYear">Año de graduación</label>
                            <input class="form-input" type="date" name="graduationYear" value="<?= isset($inscriptionDetails['graduationYear']) ? htmlspecialchars($inscriptionDetails['graduationYear']) : '' ?>" required />
                        </div>

                        <!-- Nombre Titulo -->
                        <div class="form-group_control">
                            <label for="degreeTitle">Nombre del título</label>
                            <input class="form-input" type="text" name="degreeTitle" value="<?= isset($inscriptionDetails['degreeTitle']) ? htmlspecialchars($inscriptionDetails['degreeTitle']) : '' ?>" required />
                        </div>

                        <!-- Promedio -->
                        <div class="form-group_control">
                            <label for="gradePointAverage">Promedio</label>
                            <input class="form-input" type="number" name="gradePointAverage" placeholder="0.000" step="0.001" value="<?= isset($inscriptionDetails['gradePointAverage']) ? htmlspecialchars($inscriptionDetails['gradePointAverage']) : '' ?>" required />
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
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoUno.js"></script>
</body>
</html>
