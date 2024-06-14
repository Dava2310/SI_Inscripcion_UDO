<?php

session_start();

include_once("../clases/usuario.php");

function modificarUser()
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
    $response = $user->updateUser($_GET['id'], $name, $lastName, $email, $licenseID);

    if (!$response) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al actualizar empleado'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Actualización exitosa'));
}

header('Content-Type: application/json');
modificarUser();
