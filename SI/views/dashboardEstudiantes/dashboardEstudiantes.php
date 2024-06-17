<?php
$_title = "Panel de Control";
include ('./../templates/head.php');


include_once ('../../controllers/clases/estudiante.php');
include_once ('../../controllers/clases/notificaciones.php');
include_once ('../../controllers/clases/inscripcion.php');

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
$birthday = $response['birthday'];
$nationality = $response['nationality'];
$address = $response['address'];
$ID = $response['ID'];

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

<body>

    <div class="main-container">

        <!-- MENU DE NAVEGACION -->
        <?php
        include ("./../templates/menus/menuEstudiante.php");
        ?>

        <main>
            <div class="info-container">
                <h1>Datos de Perfil: Estudiante</h1>

                <form id="form" action="">
                    <div class="form-grid_container">

                    <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" value="<?= $name ?>" disabled class="form-control" type="text"
                                name="name" id="name">
                        </div>

                        <input hidden disabled name="ID" id="ID" type="text" value="<?=$ID?>">

                        <div class="form-group_control">
                            <label for="lastName">Apellido:</label>
                            <input class="form-input" value="<?= $lastName ?>" disabled class="form-control" type="text"
                                name="lastName" id="lastName">
                        </div>

                        <div class="form-group_control">
                            <label for="licenseID">Cedula:</label>
                            <input class="form-input" value="<?= $licenseID ?>" disabled class="form-control"
                                type="text" name="licenseID" id="licenseID">
                        </div>

                        <div class="form-group_control">
                            <label for="email">Correo:</label>
                            <input class="form-input" value="<?= $email ?>" disabled class="form-control" type="text"
                                name="email" id="email">
                        </div>

                        <div class="form-group_control">
                            <label for="birthday">Fecha:</label>
                            <input disabled value="<?=$birthday?>" class="form-input" type="date" id="birthday" name="birthday" required>
                        </div>

                        <div class="form-group_control">
                            <label for="nationality">Nacionalidad:</label>
                            <select disabled value="<?=$nationality?>" class="form-input" id="nationality" name="nationality" required>
                                <option value="venezolano">Venezolano</option>
                                <option value="extranjero">Extranjero</option>
                            </select>
                        </div>

                        <div class="form-group_control">
                            <label for="address">Direccion:</label>
                            <input disabled value="<?=$address?>" class="form-input" type="text" id="address" name="address" required style="width: 100%;">
                            <p id="errorAddress"></p>
                        </div>

                        <div class="form-group_control">
                            <label for="phoneNumber">Telefono:</label>
                            <input disabled value="<?=$phoneNumber?>" class="form-input" type="text" id="phoneNumber" name="phoneNumber" required>
                            <p id="errorPhoneNumber"></p>
                        </div>

                        <div class="form-group_control">
                            <label for="password">Contraseña:</label>
                            <input disabled class="form-input" class="form-control" type="password" name="password"
                                id="password">
                        </div>


                        <div class="group_buttons">
                            <button id="btnHabilitar" type="button" onclick="enableFields()">Habilitar Campos
                                (Desactivados)</button>
                            <button id="btnGuardar" type="submit" disabled>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- SCRIPT PARA HABILITAR LOS CAMPOS -->
    <script>
        function enableFields() {
            var inputs = document.getElementsByTagName('input');

            var btnHabilitar = document.getElementById("btnHabilitar") 
            var btnGuardar = $("#btnGuardar");

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                var inputId = input.id;

                input.disabled = !input.disabled;
            }

            // Habilitar o deshabilitar el botón submit
            btnGuardar.prop("disabled", !btnGuardar.prop("disabled"));

            var textoActual = btnHabilitar.textContent;
            var textoNuevo = "";

            if (textoActual.includes("Activados")) {
                textoNuevo = textoActual.replace("Activados", "Desactivados");
            } else if (textoActual.includes("Desactivados")) {
                textoNuevo = textoActual.replace("Desactivados", "Activados");
            } else {
                textoNuevo = textoActual + " (Activados)";
            }

            btnHabilitar.textContent = textoNuevo;

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SCRIPT PARA EL ENVIO DE LOS DATOS -->
    <script src="../../assets/js/dashboardEstudiantes/dashboardEstudiantes.js"></script>
</body>

</html>