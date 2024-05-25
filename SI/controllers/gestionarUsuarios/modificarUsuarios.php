<?php

session_start();

include_once("../clases/usuario.php");

function modificarUsuario()
{
    // Obteniendo datos del formulario 
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";

    // Registrar estudiante
    $user = new Usuario();
    $response = $user->updateUser($_GET['id'], $name, $lastName, $email, $licenseID);

    // Error al actualizar?
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al actualizar empleado'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Actualizacion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
modificarUsuario();
