<?php
session_start();
include_once("../../controllers/clases/inscripcion.php");
include_once("../../controllers/clases/periodo.php");
include_once("../../controllers/clases/carreraSeleccionada.php");
include_once("../../controllers/clases/notificaciones.php");

function respondWithError($message)
{
    session_destroy();
    http_response_code(500);
    echo json_encode(['message' => $message]);
    exit;
}

function inscriptionsRUSIUpdate($idInscription, $selectedCareers, $careerOne, $careerTwo, $careerThree)
{
    $selectedCareerObject = new SelectedCareer();
    $inscriptionObject = new Inscription();
    $idStudent = $_SESSION['ID'];

    try {
        $responseOne = $selectedCareerObject->updateSelectedCareerById($selectedCareers[0]['ID'], $careerOne);
        $responseTwo = $selectedCareerObject->updateSelectedCareerById($selectedCareers[1]['ID'], $careerTwo);
        $responseThree = $selectedCareerObject->updateSelectedCareerById($selectedCareers[2]['ID'], $careerThree);

        if (!$responseOne || !$responseTwo || !$responseThree) {
            throw new Exception('Error al actualizar las carreras seleccionadas.');
        }

        $response = $inscriptionObject->levelToInscriptionPhaseTwo($idInscription, 2);

        if (!$response) {
            throw new Exception('Error al actualizar la fase de inscripción.');
        }

        http_response_code(200);
        echo json_encode(['message' => 'Inscripción actualizada exitosamente']);

        //Enviar Notificacion
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $content = 'Se ha actualizado correctamente los datos, ahora debe esperar a que el personal revise sus datos en horas laborales. Sea paciente';

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
    } catch (Exception $e) {
        respondWithError($e->getMessage());
    }
}

function inscriptionsRUSI()
{
    $periodObject = new Period();
    $selectedCareerObject = new SelectedCareer();
    $inscriptionObject = new Inscription();

    try {
        $idInscription = $_SESSION['idInscription'];
        $currentPeriod = $periodObject->getCurrentPeriod();
        $currentPeriodId = $currentPeriod['ID'];

        $careerOne = $_POST['career1'];
        $careerTwo = $_POST['career2'];
        $careerThree = $_POST['career3'];

        $selectedCareers = $selectedCareerObject->getSelectedCareersByInscriptionID($idInscription);

        if ($selectedCareers && count($selectedCareers) > 0) {
            if (count($selectedCareers) === 3) {
                inscriptionsRUSIUpdate($idInscription, $selectedCareers, $careerOne, $careerTwo, $careerThree);
            } else {
                throw new Exception('Número de carreras seleccionadas inconsistente.');
            }
            return;
        }

        $responseOne = $selectedCareerObject->registerSelectedCareer($idInscription, $careerOne, $currentPeriodId);
        $responseTwo = $selectedCareerObject->registerSelectedCareer($idInscription, $careerTwo, $currentPeriodId);
        $responseThree = $selectedCareerObject->registerSelectedCareer($idInscription, $careerThree, $currentPeriodId);

        if (!$responseOne || !$responseTwo || !$responseThree) {
            throw new Exception('Error al registrar las carreras seleccionadas.');
        }

        $response = $inscriptionObject->levelToInscriptionPhaseTwo($idInscription, 2);

        if (!$response) {
            throw new Exception('Error al actualizar la fase de inscripción.');
        }

        http_response_code(200);
        echo json_encode(['message' => 'Inscripción registrada exitosamente']);



        //Enviar Notificacion
        $idStudent = $_SESSION['ID'];
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $content = 'Se ha cargado correctamente los datos, ahora debe esperar a que el personal revise sus datos en horas laborales. Sea paciente';

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
    } catch (Exception $e) {
        respondWithError($e->getMessage());
    }
}

function inscriptionsOpsuConventionUpdate($idInscription, $selectedCareers, $singleCareer)
{
    $selectedCareerObject = new SelectedCareer();
    $inscriptionObject = new Inscription();

    try {
        if (count($selectedCareers) === 1) {
            $responseSingle = $selectedCareerObject->updateSelectedCareerById($selectedCareers[0]['ID'], $singleCareer);
            if (!$responseSingle) {
                throw new Exception('Error al actualizar la carrera seleccionada.');
            }

            $response = $inscriptionObject->levelToInscriptionPhaseTwo($idInscription, 2);
            if (!$response) {
                throw new Exception('Error al actualizar la fase de inscripción.');
            }

            http_response_code(200);
            echo json_encode(['message' => 'Inscripción actualizada exitosamente']);

            //Enviar Notificacion
            $idStudent = $_SESSION['ID'];
            $date = new DateTime();
            $strDate = $date->format('d/m/Y H:i:s');
            $content = 'Se ha Actualizado correctamente los datos, ahora debe esperar a que el personal revise sus datos en horas laborales. Sea paciente';

            $notificationObject = new Notification();
            $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
            return;
        } else {
            throw new Exception('Número de carreras seleccionadas inconsistente.');
        }
    } catch (Exception $e) {
        respondWithError($e->getMessage());
    }
}

function inscriptionsOpsuConvention()
{
    $periodObject = new Period();
    $selectedCareerObject = new SelectedCareer();
    $inscriptionObject = new Inscription();

    try {
        $idInscription = $_SESSION['idInscription'];
        $currentPeriod = $periodObject->getCurrentPeriod();
        $currentPeriodId = $currentPeriod['ID'];

        $singleCareer = $_POST['singleCareer'];

        $selectedCareers = $selectedCareerObject->getSelectedCareersByInscriptionID($idInscription);

        if ($selectedCareers && count($selectedCareers) > 0) {
            if (count($selectedCareers) === 1) {
                inscriptionsOpsuConventionUpdate($idInscription, $selectedCareers, $singleCareer);
            } else {
                throw new Exception('Número de carreras seleccionadas inconsistente.');
            }
            return;
        }

        $responseSingle = $selectedCareerObject->registerSelectedCareer($idInscription, $singleCareer, $currentPeriodId);

        if (!$responseSingle) {
            throw new Exception('Error al registrar la carrera seleccionada.');
        }

        $response = $inscriptionObject->levelToInscriptionPhaseTwo($idInscription, 2);
        if (!$response) {
            throw new Exception('Error al actualizar la fase de inscripción.');
        }

        http_response_code(200);
        echo json_encode(['message' => 'Inscripción registrada exitosamente']);

        //Enviar Notificacion
        $idStudent = $_SESSION['ID'];
        $date = new DateTime();
        $strDate = $date->format('d/m/Y H:i:s');
        $content = 'Se ha cargado correctamente los datos, ahora debe esperar a que el personal revise sus datos en horas laborales. Sea paciente';

        $notificationObject = new Notification();
        $response = $notificationObject->sendNotificationByStudentId($idStudent, $content, $strDate);
    } catch (Exception $e) {
        respondWithError($e->getMessage());
    }
}

function crearInscripcionPasoDos()
{
    try {
        $inscriptionProcess = $_POST['inscriptionProcess'];

        if ($inscriptionProcess == '2') {
            inscriptionsRUSI();
        } else {
            inscriptionsOpsuConvention();
        }
    } catch (Exception $e) {
        respondWithError('Error en el proceso de inscripción: ' . $e->getMessage());
    }
}

header('Content-Type: application/json');
crearInscripcionPasoDos();
