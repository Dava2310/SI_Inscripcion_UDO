<?php
session_start();

include_once("../clases/estudiante.php");
include_once("../clases/usuario.php");

function checkAndRetrieveParams($params)
{
    $missingParams = array_filter($params, function ($param) {
        return !isset($_POST[$param]);
    });

    if (!empty($missingParams)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Faltan los siguientes parámetros:', 'missing_params' => $missingParams));
        exit;
    } else {
        $paramValues = array();
        foreach ($params as $param) {
            $paramValues[$param] = $_POST[$param];
        }
        return $paramValues;
    }
}

function checkUserIDType($email)
{
    $studentObject = new Student();
    $userObject = new User();

    if ($studentObject->checkEmail($email)) {
        return 'student';
    } elseif ($userObject->checkEmail($email)) {
        return 'user';
    } else {
        return 'unknown';
    }
}

function updatePassword($objectType, $email, $password, $securityAnswer, $securityQuestion, $ID)
{
    $response = false;
    $message = 'Error al cambiar la contraseña. Verifique las credenciales.';

    if ($objectType === 'student') {
        $student = new Student();
        $response = $student->updatePassword($email, md5($password), md5($securityAnswer), $securityQuestion, $ID);
    } elseif ($objectType === 'user') {
        error_log("POR AQUI", 0);
        $user = new User();
        $response = $user->updatePassword($email, md5($password), md5($securityAnswer), $securityQuestion, $ID);
        error_log("Respuesta: $response", 0);
    }

    if (!$response) {
        session_destroy();
        http_response_code(401);
    } else {
        http_response_code(200);
        $message = 'Modificación con éxito';
    }

    echo json_encode(array('message' => $message));
    exit;
}

function recuperarPassword()
{
    $params = checkAndRetrieveParams(["email", "password", "securityAnswer", "ID", "securityQuestion"]);

    $email = $params['email'];
    $password = $params['password'];
    $securityAnswer = $params['securityAnswer'];
    $ID = $params['ID'];
    $securityQuestion = $params['securityQuestion'];

    $userType = checkUserIDType($email);
    updatePassword($userType, $email, $password, $securityAnswer, $securityQuestion, $ID);
}


header('Content-Type: application/json');
recuperarPassword();
