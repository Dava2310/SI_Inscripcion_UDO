<?php

session_start();

include_once("../clases/estudiante.php");

function registrarEstudiantes()
{
    // Obteniendo datos del formulario 
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";
    $phoneNumber = $_POST['phoneNumber'] ?? "";
    $address = $_POST['address'] ?? "";

    // Registrar estudiante
    $studentObject = new Student();
    $response = $studentObject->registerStudent($licenseID, $name, $lastName, $email, md5($password), $phoneNumber, $address);

    // Error al registrarse?
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al registrar estudiante'));
        exit;
    }

    // Iniciar Sesion Usuario
    $response = $studentObject->validateStudent($email, md5($password));

    // Error al iniciar Sesion?
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al iniciar sesion'));
        exit;
    }

    //Si se encontró al usuario, se le dirige a la página que le corresponde
    $_SESSION['ID'] = $response['ID'];
    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Inicio de Sesion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
registrarEstudiantes();
