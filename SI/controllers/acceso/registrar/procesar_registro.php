<?php
// Dependencias
require_once '../models/conexionBBDD.php';
require_once '../models/asignarToken.php';

$conexion = new BaseDeDatos();
session_start();


// OBTENCION DE DATOS DEL USUARIO

// Nombre Completo
$primerNombre = $_POST['primerNombre'];
$segundoNombre = $_POST['segundoNombre'];
$primerApellido = $_POST['primerApellido'];
$segundoApellido = $_POST['segundoApellido'];

// Campos especiales
$cedula = $_POST['cedula'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Registrar usuario a la base de datos
$consulta = $conexion->query("INSERT INTO estudiantes(primerNombre, segundoNombre, primerApellido, segundoApellido, cedula, correo, contrasena) VALUES('$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$cedula', '$correo', '$contrasena')");

// (A partir de aqui, se asume que el registro fue exitoso)
asignarToken($conexion, $cedula);

// Guardando Credenciales basicas en la sesion
$_SESSION['primer_nombre'] = $primerNombre;
$_SESSION['primer_apellido'] = $primerApellido;

// Redireccionando al panel de control
header('Location: ../panelDeControl');
   
exit;
