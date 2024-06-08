<?php
$title = "Solicitar Inscripcion";
include('./../templates/encabezadoConfig.php');
include('../../controllers/clases/inscripciones.php');
include('../../controllers/clases/estudiante.php');

session_start();

// Obtener datos de la inscripcion
$studentId = $_SESSION['ID'];

// Buscar inscripcion por ID del estudiante
$inscription = new Inscription();
$inscriptionId = $inscription->getInscriptionByStudentId($studentId);

if ($inscriptionId) {
    $inscriptionDetails = $inscription->getInscriptionByID($inscriptionId);

    // Esta en fase 1, pero sin revisar
    if ($inscriptionDetails['inscriptionPhase'] === 1 && $inscriptionDetails['idState'] === 1) {
        echo "<script> window.alert('Esta fase esta en revision, espere');</script>";
        echo "<script> window.location='../dashboardEstudiantes/dashboardEstudiantes.php'; </script>";
    }

    // Esta en otra fase
    if ($inscriptionDetails['inscriptionPhase'] !== 1) {
        echo "<script> window.alert('No esta en esta fase de la inscripcion');</script>";
        echo "<script> window.location='../dashboardEstudiantes/dashboardEstudiantes.php'; </script>";
    }
}

?>

<body>
    <div class="content">
        <div class="form-inscription">
            <form id="form" action="../../controllers/gestionarInscripciones/crearInscripcionPasoUno.php" method="post">
                <div>
                    <h2>Paso 1 de 3: Datos basicos</h2>
                </div>
                <div>
                    <label for="opsuCode">Codigo de Opsu</label>
                    <input type="text" name="opsuCode" required />
                </div>
                <div>
                    <label for="degreeCode">Codigo de titulo</label>
                    <input type="text" name="degreeCode" required />
                </div>
                <div>
                    <label for="campusAddress">Direccion Plantel</label>
                    <input type="text" name="campusAddress" required />
                </div>
                <div>
                    <label for="graduationYear">Año de graduacion</label>
                    <input type="date" name="graduationYear" required />
                </div>
                <div>
                    <label for="degreeTitle">Nombre del titulo</label>
                    <input type="text" name="degreeTitle" required />
                </div>
                <div>
                    <label for="gradePointAverage">Promedio</label>
                    <input type="number" name="gradePointAverage" placeholder="0.000" required />
                </div>

                <button type="submit" class="formButton">Enviar</button>
                <button type="button" class="formButton">Deshacer todo</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcionPasoUno.js"></script>
</body>

</html>