<?php
    // Dependencias
    session_start();
    $conexion = require_once '../models/conexionBBDD.php';    

    // OBTENCION DE DATOS DEL ESTUDIANTE
    $cedula = $_POST['cedula'];
    $contrasena = $_POST['contrasena'];

    // Hacer la comprobacion de los datos
    $result = mysqli_query($conexion, "SELECT * FROM autenticacion WHERE cedula = $cedula AND password = $contrasena");

    if (!$result->num_rows > 0) {
        echo "La cedula o la contraseña es incorrecta";
    }
    
    asignarToken($conexion, $cedula);

    // Guardando Credenciales basicas en la sesion
    $_SESSION['primer_nombre'] = $primerNombre;
    $_SESSION['primer_apellido'] = $primerApellido;

    // Redireccionando al panel de control
    header('Location: ../panelDeControl');
    exit;    
?>