<?php

$_title = "Modificar Estudiante";
include ("../templates/head.php");

// Inicio de la Sesion
session_start();
$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Importando la clase Estudiante
include_once('../../controllers/clases/estudiante.php');

// Obteniendo los datos del estudiante segun el ID proveniente del Metodo GET
// Por el cual fue invocada esta pagina
$studentID = $_GET['id'];
$student = new Student();
$studentDetails = $student->getStudentByID($studentID);

?>


<body>
    <div class="main-container">
        <?php
        // No hacemos la verificación de qué menú desplegar
        // Ya que esta pantalla solo debería ser visible para un Administrador
        include('../templates/menus/menuAdministrador.php');
        ?>

        <main>
            <div class="info-container">
                <h1>Modificar Estudiante</h1>
                <form id="form" action="../../controllers/gestionarEstudiantes/modificarEstudiante.php?id=<?= $studentID ?>" method="post">
                    <div class="form-grid_container_register_one_column">
                        <!-- Nombre -->
                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" type="text" id="name" name="name" value="<?= $studentDetails['name'] ?>">
                        </div>
                        <!-- Apellido -->
                        <div class="form-group_control">
                            <label for="lastName">Apellido:</label>
                            <input class="form-input" type="text" id="lastName" name="lastName" value="<?= $studentDetails['lastName'] ?>">
                        </div>
                        <!-- Correo Electrónico -->
                        <div class="form-group_control">
                            <label for="email">Correo Electrónico:</label>
                            <input class="form-input" type="email" id="email" name="email" value="<?= $studentDetails['email'] ?>">
                        </div>
                        <!-- Cédula -->
                        <div class="form-group_control">
                            <label for="licenseID">Cédula:</label>
                            <input class="form-input" type="text" id="licenseID" name="licenseID" value="<?= $studentDetails['licenseID'] ?>">
                        </div>
                        <!-- Teléfono -->
                        <div class="form-group_control">
                            <label for="phoneNumber">Teléfono:</label>
                            <input class="form-input" type="text" id="phoneNumber" name="phoneNumber" value="<?= $studentDetails['phoneNumber'] ?>">
                        </div>
                        <!-- Dirección -->
                        <div class="form-group_control">
                            <label for="address">Dirección:</label>
                            <input class="form-input" type="text" id="address" name="address" value="<?= $studentDetails['address'] ?>">
                        </div>
                    </div>
                    <div class="group_buttons">
                        <button type="button" onclick="clearValues()">Restaurar Valores</button>
                        <button id="btnGuardar" type="submit">Guardar Cambios</button>
                        <button type="button" id="delete">Eliminar Estudiante</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarEstudiantes/modificarEstudiante.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>