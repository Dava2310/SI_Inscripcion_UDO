<?php

session_start();
include_once("../clases/rol.php");

function modificarRoles()
{
    $name = $_POST['name'] ?? "";
    $description = $_POST['description'] ?? "";

    $roleID = $_GET['id'] ?? null;

    if ($roleID === null) {
        echo json_encode(array('message' => 'ID de rol no proporcionada'));
        http_response_code(400);
        exit;
    }

    $role = new Role();
    $response = $role->updateRole($roleID, $name, $description);

    if (!$response) {
        echo json_encode(array('message' => 'Error al modificar rol'));
        http_response_code(500);
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Actualizacion Rol'));
}


header('Content-Type: application/json');
modificarRoles();
