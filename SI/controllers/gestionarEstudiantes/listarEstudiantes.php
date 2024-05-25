<?php

session_start();

include_once("../clases/estudiante.php");

function listarEstudiantes()
{
    // // Obteniendo datos del formulario 
    // $searchText = $_GET['search'];

    // // Registrar estudiante
    // $studentObject = new Student();
    // $response = $studentObject->getStudent($_GET['id'], $licenseID, $name, $lastName, $email, $phoneNumber, $address);

    // // Error al actualizar?
    // if (!$response) {
    //     session_destroy();
    //     http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
    //     echo json_encode(array('message' => 'Error al actualizar estudiante'));
    //     exit;
    // }

    // http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    // echo json_encode(array('message' => 'Actualizacion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
modificarEstudiante();
