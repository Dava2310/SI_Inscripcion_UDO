<?php
session_start();
include_once("../clases/inscripcion.php");
include_once("../clases/estudiante.php");
include_once("../clases/periodo.php");
include_once("../clases/notificaciones.php");

function crearInscripcionPasoTres()
{
    // Verificar si el ID del estudiante está en la sesión
    if (!isset($_SESSION['ID'])) {
        http_response_code(400);
        echo json_encode(array('error' => 'ID del estudiante no está en la sesión.'));
        exit;
    }

    $studentId = $_SESSION['ID'];
    $student = new Student();
    $studentDetails = $student->getStudentByID($studentId);

    // Obtener el proceso de inscripción del estudiante
    $inscriptionObject = new Inscription();
    $inscriptionDetails = $inscriptionObject->getInscriptionByStudentId($studentId);
    $process = $inscriptionDetails['idProcess'];

    // Definir los campos requeridos
    $requiredFields = ['licenseID', 'notes', 'degree', 'birthCertificate', 'spreadsheet', 'letter'];

    // Definir un array para almacenar los errores
    $errors = array();

    // Crear la carpeta de destino si no existe
    $carpeta_destino = '../../assets/fs/';
    if (!file_exists($carpeta_destino) && !mkdir($carpeta_destino, 0777, true)) {
        http_response_code(500);
        echo json_encode(array('error' => 'No se pudo crear la carpeta de destino.'));
        exit;
    }

    // Obtener la fecha actual
    $time = time();

    // Verificar si todos los archivos requeridos están presentes
    foreach ($requiredFields as $field) {
        if (!isset($_FILES[$field]) || empty($_FILES[$field]['name'])) {
            $errors[] = 'El campo ' . $field . ' es obligatorio.';
        } else {
            error_log("Archivo '$field' presente: " . $_FILES[$field]['name']);
        }
    }

    // Si hay errores, retornarlos
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(array('errors' => $errors));
        exit;
    }

    // Si no hay errores, proceder a subir los archivos
    foreach ($requiredFields as $field) {
        $extension = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $baseName = $studentDetails['ID'] . '-' . $time . '-' . $field . '.' . $extension;
        $archivo_destino = $carpeta_destino . basename($baseName);

        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $archivo_destino)) {
            $errors[] = 'Hubo un error al subir el archivo ' . $field . '.';
        } else {
            error_log("Archivo '$field' subido exitosamente a '$archivo_destino'");
        }
    }

    // Si ocurrieron errores al subir los archivos, retornarlos
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(array('errors' => $errors));
        exit;
    }

    // Si no hay errores, todo se subió correctamente y se debe cambiar al estado "En Revision"
    $response = $inscriptionObject->levelToInscriptionPhaseThreeForCheck($inscriptionDetails['ID'], $studentDetails['ID'] . '-' . $time . '-');

    if (!$response) {
        session_destroy();
        http_response_code(500);
        echo json_encode(array('message' => 'Error al proceder'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Documentos subidos exitosamente'));

    // Enviar Notificación
    $idStudent = $_SESSION['ID'];
    $date = new DateTime();
    $strDate = $date->format('d/m/Y H:i:s');
    $content = 'Se ha cargado correctamente los documentos, ahora debe esperar a que el personal revise sus datos en horas laborales. Sea paciente';

    $notificationObject = new Notification();
    $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
}

header('Content-Type: application/json');
crearInscripcionPasoTres();
