<?php

session_start();

include_once("../clases/carrera.php");

function modificarCarreras()
{
    $name = $_POST['name'] ?? "";
    $description = $_POST['description'] ?? "";
    $code = $_POST['code'] ?? "";

    $career = new Career();
    $response = $career->updateCareer($_GET['id'], $name, $description, $code);

    if (!$response) {
        session_destroy();
        http_response_code(401);
        echo json_encode(array('message' => 'Error al actualizar carrera'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Actualizacion Carrera'));
}


header('Content-Type: application/json');
modificarCarreras();
