<?php
<<<<<<< HEAD
// Importando clases
include_once('../controllers/clases/usuario.php');

// Inicio de la sesion
session_start();
$id = $_SESSION['ID'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../registros/login.php'; </script>";
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
include('./templates/encabezadoConfig.php');
?>

<body>
    <?php include("./templates/menus/menuAdministrador.php") ?>
    <div class="content">
        <h1>Hola <?= $name ?> <?= $lastName ?></h1>
        <p>Correo: <?= $email ?> | Cedula: <?= $licenseID ?></p>
    </div>
</body>

</html>
=======

/*

Primero: Validar la Session con el ID que se guarda dentro de ella
Segundo: Verificar con el ID del usuario, que tipo de usuario es:
    - Administrador
    - Empleado

Tercero: Lanzar como template o copiar y pegar el menu segun corresponda
con las opciones o requisitos que manejan correspondientes

Cuarto: El resto del dashboard es netamente, los datos personales
de ese usuario

/*
>>>>>>> 902fde0f974c1ed733d65a04c888e6d004643c1c
