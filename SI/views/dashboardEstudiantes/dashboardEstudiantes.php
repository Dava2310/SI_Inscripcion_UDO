<?php
$_titulo = "Inicio";
include_once('../../controllers/clases/estudiante.php');

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
include('./../templates/encabezadoConfig.php');
?>

<body>
    <?php include("./../templates/menus/menuEstudiante.php") ?>
    <div class="content">
        <h1>¡Hola <?= $name ?> <?= $lastName ?>!</h1>
        <p>Correo: <?= $email ?> | Cedula: <?= $licenseID ?> | Telefono: <?= $phoneNumber ?></p>

        <div class="notification-list">
            <h2>Notificaciones</h2>
            <div class="notification">
                <div class="notification-content">
                    <h2 class="notification-title">Aviso General: </h2>
                    <p class="notification-text">Se ha aperturado las inscripcciones, ponte las pilas</p>
                </div>
            </div>
            <div class="notification">
                <div class="notification-content">
                    <h2 class="notification-title">Aviso para ti: </h2>
                    <p class="notification-text">Has sido Aprovado, Revisa "Consultar"</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>