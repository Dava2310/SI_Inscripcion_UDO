<?php

session_start();

include_once("../clases/usuario.php");

function eliminarUsuarios()
{

    // Eliminar Estudiante
    $user = new User();
    $response = $user->deleteUserById($_GET['id']);

    // Error al eliminar?
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al eliminar empleado'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Eliminacion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
eliminarUsuarios();
