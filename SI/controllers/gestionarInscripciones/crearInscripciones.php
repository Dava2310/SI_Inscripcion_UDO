<?php
session_start();
include_once("../clases/inscripciones.php");
include_once("../clases/estudiante.php");

function crearInscripciones()
{
    // Getting user data
    $files = ['licenseID', 'notes', 'email', 'degree', 'birthCertificate', 'spreadsheet', 'letter'];
    $description = $_POST['description'] ?? "";
    $process = $_POST['process'] ?? "";

    // Creating Date
    $date = new DateTime();
    $time = time();

    // Format date as d/m/Y H:i:s
    $strDate = $date->format('d/m/Y H:i:s');
    echo $strDate;

    // Getting Student Id
    $studentId = $_GET['id'];
    $student = new Student();
    $studentDetails = $student->getStudentByID($studentId);

    // Register inscription
    $inscription = new Inscription();


    $response = $inscription->registerInscription($studentId, $strDate, 1, $process, '/SI/assets/fs/'.$studentDetails['ID'].'-'.$time, $description);

    // Inscription failed
    if (!$response) {
        session_destroy();
        http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
        echo json_encode(array('message' => 'Error al crear inscripcion'));
        exit;
    }

    // Saving Files
    $carpeta_destino = '../../assets/fs/';

    foreach ($files as $file) {
        if (isset($_FILES[$file])) {
            $extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
            $baseName = $studentDetails['ID'] . '-' . $time . '-' . $file . '.' . $extension;

            // Crea la ruta completa del archivo de destino
            $archivo_destino = $carpeta_destino . basename($baseName);

            // Intenta mover el archivo subido a la carpeta de destino
            if (move_uploaded_file($_FILES[$file]['tmp_name'], $archivo_destino)) {
                echo "El archivo " . $file . " se ha subido correctamente.";
            } else {
                echo "Hubo un error al subir el archivo " . $file . ".";
            }
        }
    }

    http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
    //echo json_encode(array('message' => 'Creacion'));
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
crearInscripciones();
?>
