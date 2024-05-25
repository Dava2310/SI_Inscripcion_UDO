<?php

session_start();
include_once("../clases/usuario.php");

function crearUsuarios()
{
    // Obteniendo datos del formulario 
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";

    // Registrar estudiante
    $user = new Usuario();
    $response = $user->registerUser($name, $lastName, $licenseID, $email, 2, md5($password));

    // Error al crear Usuario
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al crear empleado'));
        exit;
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Creacion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
crearUsuarios();
