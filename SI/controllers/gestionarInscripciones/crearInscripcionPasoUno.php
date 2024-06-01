<?php
session_start();
include_once("../clases/inscripciones.php");
include_once("../clases/estudiante.php");




function crearInscripciones()
{
    // FASE 1: DATOS BASICOS

    // Tomando datos de la inscripccion 1 de 3
    $opsuCode = $_POST['opsuCode'];
    $degreeCode = $_POST['degreeCode'];
    $campusAddress = $_POST['campusAddress'];
    $graduationYear = $_POST['graduationYear'];
    $degreeTitle = $_POST['degreeTitle'];
    $gradePointAverage = $_POST['gradePointAverage'];

    // Creating Date
    $date = new DateTime();

    // Format date as d/m/Y H:i:s
    $strDate = $date->format('d/m/Y H:i:s');

    // Getting Student Id
    $studentId = $_SESSION['ID'];

    // Register first BasicData
    $inscription = new Inscription();
    $response = $inscription->registerInscriptionPhaseOne($studentId, $strDate, 1, 1, $opsuCode, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle);

    // Inscription failed
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al proceder'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Proceder'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
crearInscripciones();
?>
