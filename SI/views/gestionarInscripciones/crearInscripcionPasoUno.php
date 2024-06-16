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

// Creamos una instancia de la clase Career
$career = new Career();
// Obtenemos las carreras
$careers = $career->getCareers();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_title; ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="content">
        <div class="form-inscription">
            <form id="form" action="../../controllers/gestionarInscripciones/crearInscripcionPasoUno.php" method="post">
                <div>
                    <h2>Paso 1 de 3: Datos básicos</h2>
                </div>

                <!-- Codigo Opsu -->
                <div>
                    <label for="opsuCode">Codigo de Opsu</label>
                    <input type="text" name="opsuCode" required />
                </div>

                <!-- Codigo Titulo -->
                <div>
                    <label for="degreeCode">Codigo de título</label>
                    <input type="text" name="degreeCode" required />
                </div>

                <!-- Direccion Plantel -->
                <div>
                    <label for="campusAddress">Direccion Plantel</label>
                    <input type="text" name="campusAddress" required />
                </div>

                <!-- Año Graduacion -->
                <div>
                    <label for="graduationYear">Año de graduación</label>
                    <input type="date" name="graduationYear" required />
                </div>

                <!-- Nombre Titulo -->
                <div>
                    <label for="degreeTitle">Nombre del título</label>
                    <input type="text" name="degreeTitle" required />
                </div>

                <!-- Promedio -->
                <div>
                    <label for="gradePointAverage">Promedio</label>
                    <input type="number" name="gradePointAverage" placeholder="0.000" required />
                </div>

                <!-- Enviar -->
                <button type="submit" class="formButton">Enviar</button>

                <!-- Deshacer -->
                <button type="button" class="formButton">Deshacer todo</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoUno.js"></script>
</body>
</html>
