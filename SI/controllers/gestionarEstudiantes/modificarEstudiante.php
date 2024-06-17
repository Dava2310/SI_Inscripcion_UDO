<?php

session_start();

include_once ("../clases/estudiante.php");
include_once ("../clases/usuario.php");

function modificarEstudiante()
{
    // Obteniendo datos del formulario 
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";
    $phoneNumber = $_POST['phoneNumber'] ?? "";
    $address = $_POST['address'] ?? "";
    $birthday = $_POST['birthday'] ?? "";
    $ID = $_GET['id'];

    try {
        // Verificación de que ninguno de los campos esté vacío
        if (empty($name) || empty($lastName) || empty($licenseID) || empty($email) || empty($birthday) || empty($address) || empty($phoneNumber) || empty($ID)) {
            throw new Exception('Todos los campos son obligatorios');
        }

        $studentObject = new Student();
        $userObject = new User();

        // Primero verificar que esta cedula no se repita en ningun otro estudiante o empleado
        // Con la excepcion de que no sea el mismo a modificar
        if ($userObject->existsLicenseIDButNotUserId($licenseID, $ID) || $studentObject->existsLicenseIDButNotUserId($licenseID, $ID)) {

            // Significa que existe un empleado o correo con dicha cedula
            throw new Exception('Esta cedula ya existe en otro usuario');
        }

        // Despues, verificar que el correo no se repita en ningun otro estudiante o empleado
        if ($userObject->existsEmailButNotUserId($email, $ID) || $studentObject->existsEmailButNotUserId($email, $ID)) {

            // Significa que existe un empleado o estudiante con dicho correo
            throw new Exception('Este correo ya existe en otro usuario');
        }

        // Actualizar estudiante
        $response = $studentObject->updateStudent($ID, $licenseID, $name, $lastName, $email, $birthday, $phoneNumber, $address);

        // Error al actualizar?
        if (!$response) {
            throw new Exception('Error al Actualizar');
        }

        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Actualizacion'));

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => $e->getMessage()));
    }




}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
modificarEstudiante();
