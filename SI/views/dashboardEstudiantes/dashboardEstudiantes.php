<?php
$_titulo = "Inicio";
include_once('../../controllers/clases/estudiante.php');
include_once('../../controllers/clases/notificaciones.php');
include_once('../../controllers/clases/inscripcion.php');

// Inicio de la sesion
session_start();
$studentID = $_SESSION['ID'];

// Si no hay estudiante registrado
if (!(isset($studentID))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Recogiendo los datos del estudiante
$student = new Student();
$response = $student->getStudentByID($studentID);

// Si no hay datos, salir
if (!($response)) {
    echo "<script> window.alert('Hubo un problema');</script>";
    echo "<script> window.location='../registros/login.php'; </script>";
    die();
}

// Recoleccion de datos del array
$name = $response['name'];
$lastName = $response['lastName'];
$licenseID = $response['licenseID'];
$phoneNumber = $response['phoneNumber'];
$email = $response['email'];

// Recogiendo los datos de las notificaiones del estudiante
$notificationObject = new Notification();
$notifications = $notificationObject->getNotificationsById($studentID);

// Recogiendo los datos de la inscripcion del estudiante si tiene
$inscriptionObject = new Inscription();
$inscriptionDetails = $inscriptionObject->getInscriptionByStudentId($studentID);

if ($inscriptionDetails) {
    $_SESSION['idInscription'] = $inscriptionDetails['ID'];
}


?>

<?php
$_title = "Panel De Control";
include('./../templates/encabezadoConfig.php');
?>

<body>
    <?php include("./../templates/menus/menuEstudiante.php") ?>
    <div class="content">
        <h1>¡Hola <?= $name ?> <?= $lastName ?>!</h1>
        <p>Correo: <?= $email ?> | Cedula: <?= $licenseID ?> | Telefono: <?= $phoneNumber ?></p>

        <div class="notification-list">
            <h2>Notificaciones</h2>

            <?php



            foreach ($notifications as $notification) {

                $notificationType = "Aviso General:"; 
                
                if ($notification['idStudent']) {
                    $notificationType = "Para ti:";
                }

                echo <<<HTML
                    <div class="notification">
                        <div  class="notification-content">
                            <h2 class="notification-title">{$notificationType}</h2>
                            <p class="notification-text">{$notification['content']}</p>
                        </div>
                    </div>
                HTML;
            }
            ?>
        </div>
    </div>
    <script src="../../assets/js/dashboardEstudiantes/dashboardEstudiantes.js"></script>
</body>

</html>