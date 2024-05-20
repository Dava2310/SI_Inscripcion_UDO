<?php

    session_start();

    include_once("../clases/usuario.php");

    function iniciarSesion()
    {   
        // Obteniendo datos del formulario 
        $contrasena = $_POST['contrasena'] ?? "";
        $cedula = $_POST['cedula'] ?? ""; 
        
        
        // Iniciar sesion con dicho usuario
        $objetoUsuario = new Usuario();

        $datos = $objetoUsuario->validarUsuario($cedula, md5($contrasena));

        if (!($datos))
        {
            session_destroy();
            http_response_code(401); // Se establece el codigo de estado HTTP 401, que significa 'error'
            echo json_encode(array('message' => 'Error al iniciar sesion usuario'));
            exit;
        }
        
        // Acceder a los datos del array
        $idRol = $datos['idRol'];
        $idUsuario = $datos['idUsuario'];

        // Creando los datos de la sesion
        $_SESSION['ID'] = $idUsuario;

        //Si se encontró al usuario, se le dirige a la página que le corresponde
        http_response_code(200); // se estable el codigo de estado http 200, que significa 'ok' y que se hizo la solicitud correctamente
        echo json_encode(array('message' => 'Inicio de Sesion', 'idRol' => $idRol));

    }
    
    header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía una respuesta en formato JSON
    iniciarSesion();

?>