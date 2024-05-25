<?php

session_start();
include_once("../clases/usuario.php");
include_once("../clases/estudiante.php");

function iniciarSesion()
{
    // Obteniendo datos del formulario 
    $password = $_POST['password'] ?? "";
    $email = $_POST['email'] ?? "";

    // VERIFICAR SI ES UN USUARIO O ESTUDIANTE
    $user = new Usuario();
    $responseUser = $user->validateUser($email, md5($password));

    $student = new Student();
    $responseStudent = $student->validateStudent($email, md5($password));

    // NO ES NI USER NI ESTUDIANTE
    if (!($responseUser) && !($responseStudent)) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al iniciar sesion'));
        exit;
    }

    // ES ESTUDIANTE
    if (!($responseUser) && ($responseStudent)) {
        //Si se encontró el estudiante, se le dirige a la página que le corresponde
        $_SESSION['ID'] = $responseStudent['ID'];
        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Inicio de Sesion Estudiante'));
        exit;
    }

    // ES USER
    $idRole = $responseUser['idRole'];
    $userId = $responseUser['ID'];

    // Creando los datos de la sesion
    $_SESSION['ID'] = $userId;
    $_SESSION['ID_ROLE'] = $idRole;

    //Si se encontró al usuario, se le dirige a la página que le corresponde
    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    echo json_encode(array('message' => 'Inicio de Sesion Usuario', 'idRol' => $idRole));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
iniciarSesion();
