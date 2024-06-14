<?php

session_start();
include_once("../clases/usuario.php");

function crearUsuarios()
{
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";

    if (empty($name) || empty($lastName) || empty($email) || empty($licenseID)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Todos los campos son obligatorios.'));
        exit;
    }

    $user = new User();
    try {
        $response = $user->registerUser($name, $lastName, $licenseID, $email, 2, md5($licenseID));

        if ($response) {
            http_response_code(200);
            echo json_encode(array('message' => 'Usuario creado exitosamente'));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al crear el usuario'));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al crear el usuario: ' . $e->getMessage()));
    }
}

header('Content-Type: application/json');
crearUsuarios();
