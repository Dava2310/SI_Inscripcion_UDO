<?php

session_start();
include_once("../clases/periodo.php");

function crearPeriodos()
{
    $name = $_POST['name'] ?? "";
    $dateStart = $_POST['dateStart'] ?? "";
    $dateEnd = $_POST['dateEnd'] ?? "";

    $period = new Period();
    $response = $period->registerPeriod($name, $dateStart, $dateEnd);

    if (!$response) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al crear el periodo'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Creacion Periodo'));
}

header('Content-Type: application/json');
crearPeriodos();
