<?php
$_title = "Recuperar Contraseña";
include ('../templates/head.php');
?>

<body>

    <main class="main-login">
        <div class="form-container_login">

            <div>
                <img src="../../assets/img/logo.png" alt="Icono del Sistema">
                <div class="login-titles">
                    <h1>Bienvenido al Sistema de Nuevo Ingreso</h1>
                    <p>Ingresa tu correo para recuperar tu contraseña.</p>
                </div>
            </div>
            <form id="form" action="../../controllers/gestionarAcceso/verificarEmail.php" method="post">
                <div>
                    <label for="email">Correo electrónico:</label>
                    <input class="form-input" type="email" id="email" name="email" required placeholder="Ingresa tu correo electrónico">
                    <p id="errorEmail"></p>
                </div>    

                <div>
                    <button name="submit" type="submit">Aceptar</button>
                </div>

                <p><b>¿Ya tienes una cuenta?<a href="iniciarSesion.php"> Haz clic aquí</a>.</b></p>
                <p><b>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</b></p>
                <p><b><a href="../../index.php">Volver a Home</a>.</b></p>
            </form>
        </div>
    </main>

    <script type="module" src="./../../assets/js/gestionarAcceso/recuperarPassword.js"></script>
</body>