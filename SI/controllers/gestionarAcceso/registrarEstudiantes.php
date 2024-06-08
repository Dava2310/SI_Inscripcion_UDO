<?php

    session_start();

    include_once("../clases/estudiante.php");

    function registrarEstudiantes()
    {
        // Obteniendo datos del formulario 
        $licenseID = $_POST['licenseID'] ?? "";
        $name = $_POST['name'] ?? "";
        $lastName = $_POST['lastName'] ?? "";
        $email = $_POST['email'] ?? "";
        $date = $_POST["date"] ?? "";
        $nationality = $_POST["nationality"] ?? "";
        $phoneNumber = $_POST["phoneNumber"] ?? "";
        $address = $_POST['address'] ?? "";
        $password = $_POST['password'] ?? "";
        $securityQuestion = $_POST["securityQuestion"] ?? "";
        $securityAnswer = $_POST["securityAnswer"] ?? "";
        $state = "Active";

        // Registrar estudiante
        $studentObject = new Student();
        $response = $studentObject->registerStudent($licenseID, $name, $lastName, $email, $date, $nationality, $phoneNumber, $address, $state, md5($password), $securityQuestion, $securityAnswer);

        // Error al registrarse?
        if (!$response) {
            session_destroy();
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al registrar estudiante'));
            exit;
        }

        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Registro exitoso'));
    }

    header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
    registrarEstudiantes();
