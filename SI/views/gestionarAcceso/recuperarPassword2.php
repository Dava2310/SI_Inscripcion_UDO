<?php
$_title = "Recuperar Contraseña - Paso 2";
include ('../templates/head.php');
?>

<body>

    <main class="main-login">
        <div class="form-container_register">
            <div>
                <img src="../../assets/img/logo.png" alt="Icono del Sistema">
                <div class="login-titles">
                    <h1>Bienvenido al Sistema de Nuevo Ingreso</h1>
                    <p>Recupera tu contraseña.</p>
                </div>
            </div>

            <form id="form" action="../../controllers/gestionarAcceso/recuperarPassword.php" method="post">
                <div class="form-grid_container_register">
                    <div>
                        <label for="email">Correo electrónico:</label>
                        <input class="form-input" type="email" id="email" name="email" required>
                        <p id="errorEmail"></p>
                    </div>

                    <div>
                        <label for="securityQuestion">Pregunta de Seguridad</label>
                        <select class="form-input" id="securityQuestion" name="securityQuestion">
                            <option value="Color Favorito">¿Cuál es tu color favorito?</option>
                            <option value="Comida Favorita">¿Cuál es tu comida favorita?</option>
                            <option value="Nombre de mascota">¿Cuál es el nombre de tu mascota?</option>
                            <option value="Pelicula favorita">¿Cuál es tu película favorita?</option>
                        </select>
                    </div>

                    <div>
                        <label for="securityAnswer">Respuesta de Seguridad</label>
                        <input class="form-input" id="securityAnswer" name="securityAnswer" type="text"
                            placeholder="Respuesta de Seguridad">
                        <p id='errorSecurityAnswer'></p>
                    </div>

                    <input type="hidden" id="ID" name="ID">
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input class="form-input" type="password" id="password" name="password" required>
                    <p id="errorPassword"></p>
                </div>

                <div>
                    <label for="repassword">Confirme su contraseña:</label>
                    <input class="form-input" type="password" id="repassword" name="repassword" required>
                    <p id="errorRepassword"></p>
                </div>

                <div>
                    <button name="submit" type="submit">Aceptar</button>
                </div>

                <!-- Links -->
                <p><b>¿Olvidaste tu contraseña?<a href="recuperarPassword.php"> Haz clic aquí</a>.</b></p>
                <p><b>¿Ya tienes una cuenta?<a href="iniciarSesion.php"> Haz clic aquí</a>.</b></p>
                <p><b><a href="../../index.php">Volver a Home</a>.</b></p>
            </form>
        </div>
    </main>

    <script type="module" src="./../../assets/js/gestionarAcceso/recuperarPassword2.js"></script>
</body>

</html>