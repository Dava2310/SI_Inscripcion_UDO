<?php

session_start();
include_once("../clases/usuario.php");
include_once("../clases/estudiante.php");
include_once("../clases/logica.php");

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

        // Objectos necesarios para la corrida de este proceso
        $userObject = new User();
        $studentObject = new Student();

        // Primero verificar de que tipo de usuario es segun el email
        $objectLogica = new Logica();
        $typeUser = $objectLogica->identifyUser($email);

        // Variable que mantiene si la verificacion fue correcta o no
        $verified = false;

        if ($typeUser == "Student") {
            $responseUser = $studentObject->validateStudent($email, md5($password));
            if (!($responseUser)) {
                throw new Exception("Credenciales de Sesion Incorrectas");
            }
            $verified = true;
        } else if ($typeUser == "User") {
            $responseUser = $userObject->validateUser($email, md5($password));
            if (!($responseUser)) {
                throw new Exception("Credenciales de Sesion Incorrectas");
            }
            $verified = true;
        } else {
            throw new Exception('No hay ningun usuario con este correo');
        }

        // Usuario
        if ($verified) {

            $userId = $responseUser['ID'];
            $_SESSION['ID'] = $userId;

            // En caso de que ademas, sea empleado
            if ($typeUser == "User") {
                $idRole = $responseUser['idRole'];
                $_SESSION['ID_ROLE'] = $idRole;

                http_response_code(200);
                echo json_encode(array('message' => 'Inicio de Sesión Usuario', 'idRol' => $idRole));
                return exit;
            }
            else if ($typeUser == "Student")
            {

                // Verifiquemos si esta activo en el sistema
                $isActive = $studentObject->isActiveByID($userId);
                if (!$isActive)
                {
                    throw new Exception('Usted no está activo en el sistema');
                }

                http_response_code(200);
                echo json_encode(array('message' => 'Inicio de Sesión Estudiante'));
                return exit;
            }


        }
    } catch (Exception $e) {
        session_destroy();
        http_response_code(500);
        echo json_encode(array('message' => $e->getMessage()));
        return;
    }
}

header('Content-Type: application/json');
iniciarSesion();
