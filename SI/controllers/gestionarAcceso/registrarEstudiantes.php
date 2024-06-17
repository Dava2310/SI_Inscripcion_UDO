<?php

session_start();

include_once("../clases/estudiante.php");
include_once("../clases/notificaciones.php");
include_once("../clases/usuario.php");

function registrarEstudiantes() {
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

    try {
        $studentObject = new Student();
        $userObject = new User();

        // Primero verificar que esta cedula no se repita en ningun otro estudiante o empleado
        if ($userObject->existsLicenseID( $licenseID ) || $studentObject->existsLicenseID($licenseID)) {
            
            // Significa que existe un empleado o correo con dicha cedula
            throw new Exception('Esta cedula ya existe en otro usuario');
        }

        // Despues, verificar que el correo no se repita en ningun otro estudiante o empleado
        if ($userObject->existsEmail( $email ) || $studentObject->existsEmail( $email )) {

            // Significa que existe un empleado o estudiante con dicho correo
            throw new Exception('Este correo ya existe en otro usuario');
        }

        // Al pasar ambas verificaciones, se procede a realizarse el registro        
        $response = $studentObject->registerStudent($licenseID, $name, $lastName, $email, $date, $nationality, $phoneNumber, $address, md5($password), $securityQuestion, md5($securityAnswer));

        // Error al registrarse?
        if (!$response) {
            throw new Exception('Error al registrar estudiante');
        }

        // Enviar Notificación de bienvenida, obteniendo id del estudiante
        $response = $studentObject->validateStudent($email, md5($password));

        // Error al buscar estudiante
        if (!$response) {
            throw new Exception('Error al enviar notificación');
        }

        // Preparando Información de destinatario
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $idStudent = $response['ID'];
        $content = 'Bienvenido, para continuar con el proceso de inscripción, presione en "solicitar inscripción" y siga los pasos. Recomendable anotar en alguna parte cualquier información importante';

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);

        // Error al enviar notificación
        if (!$response) {
            throw new Exception('Error al enviar notificación');
        }

        http_response_code(200); // se establece el código de estado HTTP 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Registro exitoso'));

    } catch (Exception $e) {
        session_destroy();
        http_response_code(401); // Se establece el código de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => $e->getMessage()));
        exit;
    }
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
registrarEstudiantes();
