<?php

include_once("../clases/periodo.php");

function activarPeriodos() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $period = new Period();
        $response = $period->activatePeriod($id);

        if ($response) {
            http_response_code(200);
            echo json_encode(array('message' => 'Activacion Periodo'));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al activar el periodo'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'ID no proporcionado'));
    }
}

header('Content-Type: application/json');
activarPeriodos();

