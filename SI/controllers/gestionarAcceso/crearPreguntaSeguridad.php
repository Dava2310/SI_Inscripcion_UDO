<?php
session_start();
include_once("../clases/usuario.php");

function crearPreguntaSeguridad()
{
    $securityQuestion = $_POST['securityQuestion'] ?? "";
    $securityAnswer = $_POST['securityAnswer'] ?? "";
    $newPassword = $_POST['password'] ?? "";

    if (!isset($_SESSION['ID'])) {
        http_response_code(401);
        echo json_encode(array('message' => 'Usuario no autenticado'));
        return;
    }

    $userId = $_SESSION['ID'];

    try {
        $user = new User();
        $response = $user->createSecurityQuestion($userId, $securityQuestion, md5($securityAnswer), md5($newPassword));

        if ($response) {
            http_response_code(200);
            echo json_encode(array('message' => 'Pregunta de seguridad creada exitosamente'));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Error al crear la pregunta de seguridad'));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al crear la pregunta de seguridad: ' . $e->getMessage()));
    }
}


header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
crearPreguntaSeguridad();
?>
