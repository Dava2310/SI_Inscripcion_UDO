<?php
// Importando clases
include_once('../../controllers/clases/usuario.php');

// Inicio de la sesion
session_start();
$id = $_SESSION['ID'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Recogiendo los datos del usuario
$user = new Usuario();
$response = $user->getUserByID($id);

// Si no hay datos, se niega la autenticidad
if (!($response)) {
    echo "<script> window.alert('Hubo un problema');</script>";
    echo "<script> window.location='../registros/login.php'; </script>";
    die();
}

// Recoleccion de datos del array datosUsuario
$name = $response['name'];
$lastName = $response['lastName'];
$licenseID = $response['licenseID'];
$email = $response['email'];
?>


<?php
$title = "Panel De Control";
include('./../templates/encabezadoConfig.php');
?>

<body>
    <?php include("./../templates/menus/menuAdministrador.php") ?>
    <div class="content">
        <h1>Hola <?= $name ?> <?= $lastName ?></h1>
        <p>Correo: <?= $email ?> | Cedula: <?= $licenseID ?></p>
    </div>
</body>

</html>
