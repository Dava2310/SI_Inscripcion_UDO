<?php

    session_start();

    include_once("../clases/estudiante.php");

    function verificarEmail()
    {
        // Obtenierndo los datos del formulario
        $email = $_POST["email"] ?? "";

        // Creando un objeto de tipo estudiante
        $studentObject = new Student();
        $response = $studentObject->checkEmail($email);

        if (!$response)
        {
            session_destroy();
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al registrar estudiante'));
            exit;
        }

        $studentID = $response['ID'];
        $email = $response['email'];
        $securityQuestion = $response['securityQuestion'];
        
         // Respuesta exitosa
        http_response_code(200); // Código de estado HTTP 200, que significa 'OK'
        echo json_encode(array(
            'message' => 'Estudiante verificado con éxito',
            'student_id' => $studentID,
            'security_question' => $securityQuestion,
            'email' => $email
        ));
        exit;
    }

    header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
    verificarEmail();