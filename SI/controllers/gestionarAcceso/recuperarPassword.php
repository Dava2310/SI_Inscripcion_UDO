<?php
    
    session_start();

    include_once("../clases/estudiante.php");

    function recuperarPassword()
    {
        // Obteniendo los datos del formulario
        $email = $_POST["email"];
        $password = $_POST["password"];
        $securityAnswer = $_POST["securityAnswer"];
        $ID = $_POST["ID"];
        $securityQuestion = $_POST["securityQuestion"];

        // Creando un objeto de tipo Estudiante
        $studentObject = new Student();
        $response = $studentObject->updatePassword($email, md5($password), $securityAnswer, $securityQuestion, $ID);

        if (!$response) {
            session_destroy();
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al cambiar la contraseña. Verifique las credenciales'));
            exit;
        }

        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Modificacion con exito'));
        exit;

    }

    header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
    recuperarPassword();
