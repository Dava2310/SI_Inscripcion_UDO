<?php

include_once("../clases/periodo.php");
include_once("../clases/notificaciones.php");

function activarPeriodos()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $period = new Period();
        $response = $period->activatePeriod($id);

        if ($response) {
            http_response_code(200);
            echo json_encode(array('message' => 'Activacion Periodo'));

            $notification = new Notification();
            $idStudent = null;
            $date = new DateTime();
            $strDate = $date->format('d/m/Y H:i:s');


            $response = $notification->sendNotificationByStudentId($idStudent, "Ha empezado las inscripciones, puede solicitar el suyo siguiendo los pasos de inscripcion", $strDate);
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al activar el periodo'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'ID no proporcionado'));
    }
}

header('Content-Type: application/json');
activarPeriodos();
