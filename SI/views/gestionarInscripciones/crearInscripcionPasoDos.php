<?php
$_title = "Solicitar Inscripción";
include('./../templates/encabezadoConfig.php');
include('../../controllers/clases/inscripcion.php');
include('../../controllers/clases/estudiante.php');
include('../../controllers/clases/carrera.php'); // Incluimos la clase de Carrera

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['ID'])) {
    header('Location: ../login.php');
    exit;
}

// Obtener datos de la inscripción
$studentId = $_SESSION['ID'];

try {
    // Buscar inscripción por ID del estudiante
    $inscription = new Inscription();
    $inscriptionDetails = $inscription->getInscriptionByStudentId($studentId);

    if (!$inscriptionDetails) {
        $message = 'No está en esta fase de la inscripción';
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

<?php
$_title = "Solicitar Inscripción";
include('../templates/encabezadoConfig.php');
?>

<body>
    <div class="content">
        <div class="form-inscription">
            <form id="form" action="../../controllers/gestionarInscripciones/crearInscripcionPasoDos.php" method="post">
                <div>
                    <h2>Paso 1 de 3: Datos básicos</h2>
                </div>

                <!-- Proceso de Inscripcion -->
                <div>
                    <label for="inscriptionProcess">Proceso de Inscripción</label>
                    <select name="inscriptionProcess" id="inscriptionProcess" required onchange="showCareers()">
                        <option value="1">OPSU</option>
                        <option value="2">RUSI</option>
                        <option value="3">CONVENIO</option>
                    </select>
                </div>

                <!-- Selects para Carreras (RUSI) -->
                <div id="careersSelection" style="display: none;">
                    <!-- Select 1 -->
                    <div>
                        <label for="career1">Carrera 1</label>
                        <select name="career1" id="career1" required>
                            <?php foreach ($careers as $career) : ?>
                                <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Select 2 -->
                    <div>
                        <label for="career2">Carrera 2</label>
                        <select name="career2" id="career2" required>
                            <?php foreach ($careers as $career) : ?>
                                <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Select 3 -->
                    <div>
                        <label for="career3">Carrera 3</label>
                        <select name="career3" id="career3" required>
                            <?php foreach ($careers as $career) : ?>
                                <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Select para Carrera (OPSU y CONVENIO) -->
                <div id="singleCareerSelection">
                    <label for="singleCareer">Carrera</label>
                    <select name="singleCareer" id="singleCareer" required>
                        <?php foreach ($careers as $career) : ?>
                            <option value="<?= $career['ID'] ?>"><?= $career['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Enviar -->
                <button type="submit" class="formButton">Enviar</button>

                <!-- Deshacer -->
                <button type="button" class="formButton">Deshacer todo</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoDos.js"></script>
</body>

</html>