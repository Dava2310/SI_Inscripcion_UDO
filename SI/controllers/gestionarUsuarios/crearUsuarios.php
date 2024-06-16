<?php

session_start();

include_once("../clases/usuario.php");
include_once("../clases/estudiante.php");

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

    $userObject = new User();
    $studentObject = new Student();
    try {

        // Primero verificar que esta cedula no se repita en ningun otro estudiante o empleado
        if ($userObject->existsLicenseID( $licenseID ) || $studentObject->existsLicenseID($licenseID)) {
            
            // Significa que existe un empleado o correo con dicha cedula
            throw new Exception('Esta cedula ya existe en otro usuario');
        }

        // Despues, verificar que el correo no se repita en ningun otro estudiante o empleado
        if ($userObject->existsEmail( $email ) || $studentObject->existsEmail( $email )) {

            // Significa que existe un empleado o estudiante con dicho correo
            throw new Exception('Este correo ya existe en otro usuario');
        }

        // Al pasar ambas verificaciones, se procede a realizarse el registro 
        $response = $userObject->registerUser($name, $lastName, $licenseID, $email, 2, md5($licenseID));

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
