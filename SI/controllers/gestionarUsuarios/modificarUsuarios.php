<?php

session_start();

include_once("../clases/usuario.php");
include_once("../clases/estudiante.php");

function modificarUser()
{
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";
    $ID = $_GET['id'];

    if (empty($name) || empty($lastName) || empty($email) || empty($licenseID) || empty($ID)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Todos los campos son obligatorios.'));
        exit;
    }

    $userObject = new User();
    $studentObject = new Student();

    try {

        // Primero verificar que esta cedula no se repita en ningun otro estudiante o empleado
        // Con la excepcion de que no sea el mismo a modificar
        if ($userObject->existsLicenseIDButNotUserId( $licenseID, $ID ) || $studentObject->existsLicenseIDButNotUserId($licenseID, $ID)) {
            
            // Significa que existe un empleado o correo con dicha cedula
            throw new Exception('Esta cedula ya existe en otro usuario');
        }

        // Despues, verificar que el correo no se repita en ningun otro estudiante o empleado
        if ($userObject->existsEmailButNotUserId( $email, $ID ) || $studentObject->existsEmailButNotUserId( $email, $ID )) {

            // Significa que existe un empleado o estudiante con dicho correo
            throw new Exception('Este correo ya existe en otro usuario');
        }

        // Al pasar ambas verificaciones, se procede a realizar la modificacion
        $response = $userObject->updateUser($ID, $name, $lastName, $email, $licenseID);

        if ($response) 
        {
            http_response_code(200);
            echo json_encode(array('message' => 'Usuario modificado exitosamente'));
        } else 
        {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al modificar el usuario'));
        }

    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al modificar el usuario: ' . $e->getMessage()));
    }

}

header('Content-Type: application/json');
modificarUser();
