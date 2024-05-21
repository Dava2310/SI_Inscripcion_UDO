<?php

    session_start();

    include_once("../clases/usuario.php");

    function registrar()
    {   
        // Obteniendo datos del formulario 
        $name = $_POST['name'] ?? "";
        $lastName = $_POST['lastName'] ?? "";
        $email = $_POST['email'] ?? "";
        $password = $_POST['password'] ?? "";
        $licenseID = $_POST['licenseID'] ?? ""; 
        $idRole = $_POST['idRole'] ?? "";
        
        // Registrar estudiante
        $objetoUsuario = new Usuario();
        $respuesta = $objetoUsuario->registerUser($name, $lastName, $licenseID, $email, $idRole, md5($password));
        
        // Error al registrarse?
        if (!$respuesta) {
            session_destroy();
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al registrar un usuario'));
            exit;
        }

        //Si se encontró al usuario, se le dirige a la página que le corresponde
        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Registro exitoso'));
    }
    
    header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
    registrar();

