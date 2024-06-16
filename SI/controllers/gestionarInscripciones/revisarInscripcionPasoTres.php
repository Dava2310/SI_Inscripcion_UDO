<?php
session_start();
include_once("../../controllers/clases/inscripcion.php");

function revisarInscripcionPasoTres()
{
    // Verificar que la solicitud sea POST
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405); // Método no permitido
        echo json_encode(array('message' => 'Método no permitido'));
        exit;
    }

    // Verificar que todos los campos necesarios estén presentes
    if (!isset($_POST['decision']) || !isset($_POST['observation']) || !isset($_GET['id'])) {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(array('message' => 'Datos incompletos'));
        exit;
    }

    // Obtener valores del formulario
    $decision = $_POST['decision'];
    $observation = $_POST['observation'];
    $inscriptionId = $_GET['id'];
    

    // Instanciar objeto de inscripción
    $inscriptionObject = new Inscription();
    $inscriptionDetails = $inscriptionObject->getInscriptionByID($inscriptionId);

    // Procesar decisión
    if ($decision == "approve") {
        $response = $inscriptionObject->approveInscription($inscriptionId);

        if (!$response) {
            http_response_code(500); // Error interno del servidor
            echo json_encode(array('message' => 'Error al aprobar la inscripción'));
            exit;
        }

        http_response_code(200); // Aprobado exitosamente
        echo json_encode(array('message' => 'Inscripción aprobada exitosamente'));

    } else if ($decision == "reject") {
        $response = $inscriptionObject->rejectInscriptionDocuments($inscriptionId, $observation, $inscriptionDetails['url']);

        if (!$response) {
            http_response_code(500); // Error interno del servidor
            echo json_encode(array('message' => 'Error al rechazar la inscripción'));
            exit;
        }

        http_response_code(200); // Rechazado exitosamente
        echo json_encode(array('message' => 'Inscripción rechazada exitosamente'));

    } else {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(array('message' => 'Decisión inválida'));
        exit;
    }
}

header('Content-Type: application/json');
revisarInscripcionPasoTres();