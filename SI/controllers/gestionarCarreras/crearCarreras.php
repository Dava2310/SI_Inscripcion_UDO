<?php

session_start();
include_once("../clases/carrera.php");

function crearCarreras()
{
    // Obteniendo datos del formulario 
    $name = $_POST['name'] ?? "";
    $description = $_POST['description'] ?? "";


    // Registrar Carrera
    $career = new Career();
    $response = $career->registerCareer($name, $description);

    // Error al crear Carrera
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al crear carrera'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Creacion Carrera'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
crearCarreras();
