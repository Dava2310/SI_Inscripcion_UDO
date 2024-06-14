<?php

session_start();
include_once("../clases/usuario.php");
include_once("../clases/estudiante.php");

function iniciarSesion()
{
    if (empty($_POST['email']) || empty($_POST['password'])) {
        http_response_code(400);
        echo json_encode(array('message' => 'Correo electrónico y contraseña son obligatorios.'));
        return;
    }

    $password = $_POST['password'];
    $email = $_POST['email'];

    try {
        $user = new User();
        $responseUser = $user->validateUser($email, md5($password));

        $student = new Student();
        $responseStudent = $student->validateStudent($email, md5($password));

        // Ninguno
        if (!($responseUser) && !($responseStudent)) {
            session_destroy();
            http_response_code(401);
            echo json_encode(array('message' => 'Error al iniciar sesión'));
            return exit;
        }

        // Estudiante
        if (!($responseUser) && ($responseStudent)) {
            $_SESSION['ID'] = $responseStudent['ID'];
            http_response_code(200);
            echo json_encode(array('message' => 'Inicio de Sesión Estudiante'));
            return exit;
        }

        // Usuario
        if ($responseUser) {
            $idRole = $responseUser['idRole'];
            $userId = $responseUser['ID'];

            $_SESSION['ID'] = $userId;
            $_SESSION['ID_ROLE'] = $idRole;

            http_response_code(200);
            echo json_encode(array('message' => 'Inicio de Sesión Usuario', 'idRol' => $idRole));
            return exit;
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al iniciar sesión: ' . $e->getMessage()));
        return;
    }
}

header('Content-Type: application/json');
iniciarSesion();
