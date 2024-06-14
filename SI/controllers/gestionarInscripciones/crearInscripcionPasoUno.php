<?php
session_start();
include_once("../../controllers/clases/inscripcion.php");
include_once("../../controllers/clases/periodo.php");

function crearInscripcionPasoUno()
{
    $opsuCode = $_POST['opsuCode'];
    $degreeCode = $_POST['degreeCode'];
    $campusAddress = $_POST['campusAddress'];
    $graduationYear = $_POST['graduationYear'];
    $degreeTitle = $_POST['degreeTitle'];
    $gradePointAverage = $_POST['gradePointAverage'];

    $date = new DateTime();
    $strDate = $date->format('Y-m-d H:i:s');

    if (!isset($_SESSION['ID'])) {
        session_destroy();
        http_response_code(401);
        echo json_encode(array('message' => 'Usuario no autenticado'));
        exit;
    }
    $studentId = $_SESSION['ID'];

    $period = new Period();
    $currentPeriod = $period->getCurrentPeriod();
    if (!$currentPeriod) {
        http_response_code(400);
        echo json_encode(array('message' => 'No se encontró un periodo activo'));
        exit;
    }
    $idPeriod = $currentPeriod['ID'];


    $validity = true;
    $inscription = new Inscription();

    // Verificar si hay ya una inscripcion vigente por corregir
    $response = $inscription->getInscriptionByStudentId($studentId);
    if ($response && $response['state'] === "A Corregir") {

        $response = $inscription->updateInscription($response['ID'], $response['date'], $opsuCode, '', $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, 1, 'A Corregir', '', $validity, $studentId, null, $idPeriod);
        
        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }
    
        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción corregida exitosamente'));

    } else {
        $response = $inscription->registerInscription($strDate, $opsuCode, '', $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, 1, '', '', $validity, $studentId, null, $idPeriod);
        
        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }
    
        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción registrada exitosamente'));
    }
}

header('Content-Type: application/json');
crearInscripcionPasoUno();
