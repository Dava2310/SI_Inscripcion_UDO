<?php

session_start();

include_once("../clases/periodo.php");

function eliminarPeriodos()
{
    $period = new Period();
    $response = $period->deletePeriodById($_GET['id']);

    if (!$response) {
        session_destroy();
        http_response_code(401);
        echo json_encode(array('message' => 'Error al eliminar periodo'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Eliminacion Periodo'));
}

header('Content-Type: application/json');
eliminarPeriodos();

