<?php

include_once("../clases/periodo.php");

function terminarPeriodos() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $period = new Period();
        $response = $period->finishPeriod($id);

        if ($response) {
            http_response_code(200);
            echo json_encode(array('message' => 'Terminacion Periodo'));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al terminar el periodo'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'ID no proporcionado'));
    }
}

header('Content-Type: application/json');
terminarPeriodos();
?>
