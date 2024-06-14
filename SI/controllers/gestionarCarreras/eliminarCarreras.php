<?php

session_start();

include_once("../clases/carrera.php");

function eliminarCarreras()
{
    $career = new Career();
    $response = $career->deleteCareerById($_GET['id']);

    if (!$response) {
        session_destroy();
        http_response_code(401);
        echo json_encode(array('message' => 'Error al eliminar carrera'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Eliminacion'));
}

header('Content-Type: application/json');
eliminarCarreras();
