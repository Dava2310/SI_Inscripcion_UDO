<?php

session_start();

include_once ("../clases/estudiante.php");

function modificarPerfil()
{

    error_log('Paso por aqui', 0);

    // Obteniendo los datos del formulario
    $name = $_POST['name'] ?? "";
    $lastName = $_POST['lastName'] ?? "";
    $licenseID = $_POST['licenseID'] ?? "";
    $email = $_POST['email'] ?? "";
    $birthday = $_POST['birthday'] ?? "";
    $address = $_POST['address'] ?? "";
    $phoneNumber = $_POST['phoneNumber'] ?? "";
    $ID = $_POST["ID"] ?? "";

    try {
        // Verificación de que ninguno de los campos esté vacío
        if (empty($name) || empty($lastName) || empty($licenseID) || empty($email) || empty($birthday) || empty($address) || empty($phoneNumber) || empty($ID)) {
            throw new Exception('Todos los campos son obligatorios');
        }

        // Procedemos a realizar el cambio
        // 1. Creamos el objeto de tipo estudiante para acceder a la función de modificar
        $studentObject = new Student();

        // 2. Realizamos la modificación enviando los datos a la función
        $result = $studentObject->updateStudent($ID, $licenseID, $name, $lastName, $email, $birthday, $phoneNumber, $address);

        if ($result) {
            return true;
        } else {
            throw new Exception('No se pudo actualizar el estudiante');
        }

    } catch (Exception $e) {
        return false;
    }
}

function verificarPasssword()
{
    // Obteniendo la password del usuario
    $password = $_POST['password'] ?? "";
    $ID = $_POST['ID'];

    try {
        // Verificando que sea la password del usuario
        $studentObject = new Student();
        $result = $studentObject->verifyPassword(md5($password), $ID);

        if ($result) {
            $respuesta = modificarPerfil();
            if (!$respuesta) {
                throw new Exception('Error al modificar perfil');
            } else {
                http_response_code(200);
                echo json_encode(array('message' => 'Modificacion exitosa'));
                exit;
            }
        } else {
            throw new Exception('La contraseña no es correcta');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Error al verificar contraseña: ' . $e->getMessage()));
        exit;
    }
}

header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
verificarPasssword();