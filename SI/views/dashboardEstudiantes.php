<?php
<<<<<<< HEAD
$_titulo = "Inicio";
include_once('../controllers/clases/estudiante.php');

// Inicio de la sesion
session_start();
$studentID = $_SESSION['ID'];

// Si no hay usuario registrado
if (!(isset($studentID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../registros/login.php'; </script>";
    die();
}

// Recogiendo los datos del usuario
$student = new Student();
$response = $student->getStudentByID($studentID);

// Si no hay datos, salir
if (!($response)) {
    echo "<script> window.alert('Hubo un problema');</script>";
    echo "<script> window.location='../registros/login.php'; </script>";
    die();
}

// Recoleccion de datos del array datosUsuario
$name = $response['name'];
$lastName = $response['lastName'];
$licenseID = $response['licenseID'];
$phoneNumber = $response['phoneNumber'];
$email = $response['email'];
?>

<?php
$title = "Panel De Control";
include('./templates/encabezadoConfig.php');
?>

<body>
    <?php include("./templates/menus/menuEstudiante.php") ?>
    <div class="content">
        <h1>¡Hola <?= $name ?> <?= $lastName ?>!</h1>
        <p>Correo: <?= $email ?> | Cedula: <?= $licenseID ?> | Telefono: <?= $phoneNumber ?></p>
        <h2>Selecciona una opcion de inscripccion</h2>
    </div>
</body>

</html>
=======

/*

Primero: Validar la Session con el ID que se guarda dentro de ella
Segundo: Lanzar el menu
Tercero: El resto del dashboard es netamente, los datos personales
de ese usuario

/*
>>>>>>> 902fde0f974c1ed733d65a04c888e6d004643c1c
