<?php

session_start();
include_once("../clases/carrera.php");

function crearCarreras()
{
    $name = $_POST['name'] ?? "";
    $description = $_POST['description'] ?? "";
    $code = $_POST['code'] ?? "";

    $career = new Career();
    $response = $career->registerCareer($name, $description, $code);

    if (!$response) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al crear carrera'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Creacion Carrera'));
}


header('Content-Type: application/json');
crearCarreras();
