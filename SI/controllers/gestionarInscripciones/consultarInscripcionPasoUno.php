<?php
session_start();
include_once("../clases/inscripciones.php");
include_once("../clases/estudiante.php");

function consultarInscripccionPasoUno()
{
    // Aprobar inscripcion

    $approved = $_GET['approved'] === 'true'; // Convertir la cadena a booleano
    $inscriptionId = $_GET['id'];

    $inscription = new Inscription();

    // No aprobo
    if (!($approved)) {
        $studentInscription = $inscription->unapproveInscriptionInPhase($inscriptionId);

        if (!$studentInscription) {
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }

        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Proceder'));

        return;
    }

    // Aprobo
    $studentInscription = $inscription->approveInscriptionInPhase($inscriptionId, 2);

    // Inscription failed
    if (!$studentInscription) {
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al proceder'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Proceder'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
consultarInscripccionPasoUno();
