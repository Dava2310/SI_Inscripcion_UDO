<?php

    $_title = "Panel De Control";
    include_once('./../templates/head.php');

    // Importando clases
    include_once('../../controllers/clases/usuario.php');

    // Inicio de la sesion
    session_start();
    $id = $_SESSION['ID'];
    $idRole = $_SESSION['ID_ROLE'];

    // Si no existe una id en la $_SESSION, es porque no esta autentificado
    if (!(isset($id))) {
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
        die();
    }

    // Recogiendo los datos del usuario
    $user = new User();
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
    $securityQuestion = $response['securityQuestion'];
    $securityAnswer = $response['securityAnswer'];

    // Verificar si no hay una pregunta-respuesta de seguridad
    if (!($securityQuestion) && !($securityAnswer) && $idRole !== 1) {
        //redirigir a otra pagina
        echo "<script> window.alert('Antes de comenzar a utilizar el sistema, debe registrar una pregunta de seguridad');</script>";
        echo "<script> window.location='../gestionarAcceso/crearPreguntaSeguridad.php'; </script>";
    }

?>

<body>
    <div class="main-container">

        <!-- CONTENIDO DEL MENU DE NAVEGACION -->
        <?php
            if ($idRole === 1)
            {
                include_once('../templates/menus/menuAdministrador.php');    
            }
            else
            {
                include_once('../templates/menus/menuEmpleado.php');
            }
            
        ?>

        <main>
            <div class="info-container">
                <h1>Datos de Perfil</h1>

                <form id="form">
                    <div class="form-grid_container">

                        <div class="form-group_control">
                            <label for="name">Nombre:</label>
                            <input class="form-input" value="<?=$name?>" readOnly class="form-control" type="text" name ="name" id="name">
                        </div>

                        <div class="form-group_control">
                            <label for="Lastname">Apellido:</label>
                            <input class="form-input" value="<?=$lastName?>" readOnly class="form-control" type="text" name ="Lastname" id="Lastname">
                        </div>

                        <div class="form-group_control">
                            <label for="licenseID">Cedula:</label>
                            <input class="form-input" value="<?=$licenseID?>" readOnly class="form-control" type="text" licenseID ="licenseID" id="licenseID">
                        </div>

                        <div class="form-group_control">
                            <label for="email">Correo:</label>
                            <input class="form-input" value="<?=$email?>" readOnly class="form-control" type="text" name ="email" id="email">
                        </div>

                        <div class="form-group_control">
                            <label for="password">Contraseña:</label>
                            <input class="form-input" class="form-control" type="text" password ="password" id="password">
                        </div>

                        <div class="form-group_control">
                            <label for="rePassword">Confirme su Contraseña:</label>
                            <input class="form-input" class="form-control" type="text" name ="rePassword" id="rePassword">
                        </div>
                    </div>

                    <div class="group_buttons">
                        <button id="btnHabilitar" type="button" onclick="enableFields()">Habilitar Campos (Desactivados)</button>
                        <button id="btnGuardar" type="submit" disabled>Guardar</button>
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
</body>
</html>



