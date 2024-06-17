<?php

session_start();
include_once("../clases/notificaciones.php");

function crearNotificaciones()
{
    $content = $_POST['content'] ?? "";

    // Verificar que los campos no estén vacíos
    if (empty($content)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Todos los campos son obligatorios'));
        exit;
    }

    $notification = new Notification();
    $idStudent = null; // Suponiendo que es una notificación global, de lo contrario, obtener el ID del estudiante
    $date = new DateTime();
    $strDate = $date->format('d/m/Y H:i:s');


    $response = $notification->sendNotificationByStudentId($idStudent, $content, $strDate);

    if (!$response) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al crear la notificación'));
        exit;
    }

    http_response_code(200);
    echo json_encode(array('message' => 'Creacion Notificacion'));
}

header('Content-Type: application/json');
crearNotificaciones();
