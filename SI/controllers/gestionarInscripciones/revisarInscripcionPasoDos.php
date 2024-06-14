<?php
session_start();
include_once("../../controllers/clases/inscripcion.php");
include_once("../../controllers/clases/periodo.php");
include_once("../../controllers/clases/carreraSeleccionada.php");

function revisarInscripcionPasoDos()
{
    // Obteniendo valores
    $desicion = $_POST['decision'];
    $observation = $_POST['observation'];
    $inscriptionId = $_GET['id'];

    if ($desicion == "approve") {
        $inscriptionObject = new Inscription();
        $response = $inscriptionObject->levelToInscriptionPhaseThree($inscriptionId);

        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }

        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción aprobada exitosamente'));

    } else if ($desicion == "reject") {
        $inscriptionObject = new Inscription();
        $response = $inscriptionObject->rejectInscription($inscriptionId, $observation);

        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }

        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción rechazada exitosamente'));
    }
}



header('Content-Type: application/json');
revisarInscripcionPasoDos();
