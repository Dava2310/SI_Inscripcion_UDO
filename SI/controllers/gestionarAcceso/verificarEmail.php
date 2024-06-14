<?php

session_start();

include_once("../clases/estudiante.php");
include_once("../clases/usuario.php");

function checkAndRetrieveParam($param)
{
    if (!isset($_POST[$param])) {
        http_response_code(400);
        echo json_encode(array('message' => 'Falta el parámetro: ' . $param));
        exit;
    } else {
        return $_POST[$param];
    }
}

function checkEmailType($email)
{
    $studentObject = new Student();
    $studentResponse = $studentObject->checkEmail($email);

    $userObject = new User();
    $userResponse = $userObject->checkEmail($email);

    if ($studentResponse) {
        return $studentResponse;
    } elseif ($userResponse) {
        return $userResponse;
    } else {
        return 'unknown';
    }
}


function sendSuccessfullResponse($object)
{
    if ($object instanceof Student) {
        http_response_code(200);
        echo json_encode(array(
            'message' => 'Estudiante verificado con éxito',
            'student_id' => $object['ID'],
            'security_question' => $object['securityQuestion'],
            'email' => $object['email']
        ));
    } else {
        http_response_code(200);
        echo json_encode(array(
            'message' => 'Usuario verificado con éxito',
            'user_id' => $object['ID'],
            'security_question' => $object['securityQuestion'],
            'email' => $object['email']
        ));
    }
    exit;
}

function verificarEmail()
{
    $email = checkAndRetrieveParam('email');
    $object = checkEmailType($email);

    if ($object !== 'unknown') {
        sendSuccessfullResponse($object);
    } else {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al verificar'));
        exit;
    }
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
verificarEmail();
