<?php
session_start();
include_once("../../controllers/clases/inscripcion.php");
include_once("../../controllers/clases/periodo.php");
include_once("../../controllers/clases/carreraSeleccionada.php");
include_once("../../controllers/clases/notificaciones.php");

function revisarInscripcionPasoDos()
{
    // Obteniendo valores
    $desicion = $_POST['decision'];
    $observation = $_POST['observation'];
    $inscriptionId = $_GET['id'];

    if ($desicion == "approve") {
        $inscriptionObject = new Inscription();
        $response = $inscriptionObject->levelToInscriptionPhaseThree($inscriptionId);

        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }

        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción aprobada exitosamente'));

        // Enviar Notificacion al estudiante
        $idStudent = $inscriptionObject->getStudentByInscriptionId($inscriptionId)["ID"];
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $content = 'Se ha aprobado correctamente los datos, puede continuar con la subida de los documentos';

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);

    } else if ($desicion == "reject") {
        $inscriptionObject = new Inscription();
        $response = $inscriptionObject->rejectInscription($inscriptionId, $observation);

        if (!$response) {
            session_destroy();
            http_response_code(500);
            echo json_encode(array('message' => 'Error al proceder'));
            exit;
        }

        http_response_code(200);
        echo json_encode(array('message' => 'Inscripción rechazada exitosamente'));

        // Enviar Notificacion al estudiante
        $idStudent = $inscriptionObject->getStudentByInscriptionId($inscriptionId)["ID"];
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $content = 'Se ha rechazado los datos, vuelva a repetir los pasos para corregir, la observacion del empleado fue la siguiente: '. $observation;

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
    }
}



header('Content-Type: application/json');
revisarInscripcionPasoDos();
