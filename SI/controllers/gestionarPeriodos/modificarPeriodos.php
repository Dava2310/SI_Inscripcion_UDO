<?php

session_start();

include_once("../clases/periodo.php");

function modificarPeriodos()
{
    $name = $_POST['name'] ?? "";
    $dateStart = $_POST['dateStart'] ?? "";
    $dateEnd = $_POST['dateEnd'] ?? "";

    $period = new Period();
    $response = $period->updatePeriod($_GET['id'], $name, $dateStart, $dateEnd);

    if (!$response) {
        session_destroy();
        http_response_code(401);
        echo json_encode(array('message' => 'Error al actualizar periodo'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Actualizacion Periodo'));
}

header('Content-Type: application/json');
modificarPeriodos();

