<?php
$_title = "Configuracion de Usuario";
include ('../templates/head.php');
?>

<body>

    <main class="main-login">
        <div class="form-container_register">
            <div>
                <img src="../../assets/img/logo.png" alt="Icono del Sistema">
                <div class="login-titles">
                    <h1>Bienvenido al Sistema de Nuevo Ingreso</h1>
                    <p>Ingresa la Pregunta y Respuesta de Seguridad para la configuracion de tu usuario.</p>
                </div>
            </div>

            <form id="form" action="../../controllers/gestionarAcceso/crearPreguntaSeguridad.php" method="post"
                enctype="application/x-www-form-urlencoded">

                <div class="form-grid_container_register_one_column">

                    <!-- Contraseña Nueva -->
                    <div>
                        <label for="password">Contraseña nueva:</label>
                        <input class="form-input" type="password" id="password" name="password" required>
                        <p id="errorPassword"></p>
                    </div>
                    <!-- Repetir Contraseña -->
                    <div>
                        <label for="repassword">Confirme su nueva contraseña:</label>
                        <input class="form-input" type="password" id="repassword" name="repassword" required>
                        <p id="errorRepassword"></p>
                    </div>
                    <!-- Pregunta de Seguridad -->
                    <div>
                        <label for="securityQuestion">Pregunta de Seguridad</label>
                        <select class="form-input" id="securityQuestion" name="securityQuestion">
                            <option value="Color Favorito">¿Cuál es tu color favorito?</option>
                            <option value="Comida Favorita">¿Cuál es tu comida favorita?</option>
                            <option value="Nombre de mascota">¿Cuál es el nombre de tu mascota?</option>
                            <option value="Pelicula favorita">¿Cuál es tu película favorita?</option>
                        </select>
                    </div>
                    <!-- Respuesta de Seguridad -->
                    <div>
                        <label for="securityAnswer">Respuesta de Seguridad</label>
                        <input class="form-input" id="securityAnswer" name="securityAnswer" type="text"
                            placeholder="Respuesta de Seguridad">
                        <p id='errorAnswer'></p>
                    </div>
                </div>

                <!-- Enviar -->
                <div>
                    <button name="submit" type="submit">Aceptar</button>
                </div>
            </form>

        </div>
    </main>
    <script type="module" src="./../../assets/js/gestionarAcceso/crearPreguntaSeguridad.js"></script>
</body>
</html>