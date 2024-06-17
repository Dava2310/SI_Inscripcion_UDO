<?php
    $_title = "Registro de Estudiante";
    include_once('../templates/head.php');
?>

<body>

    <main class="main-login">
        <div class="form-container_register">
            <div>
                <img src="../../assets/img/logo.png" alt="Icono del Sistema">
                <div class="login-titles">
                    <h1>Bienvenido al Sistema de Nuevo Ingreso</h1>
                    <p>Registra tus datos para ingresar al sistema.</p>
                </div>
            </div>

            <form id="form" action="../../controllers/gestionarAcceso/registrarEstudiantes.php" method="post">
                <div class="form-grid_container_register">
                    
                    <div>
                        <label for="licenseID">Cedula:</label>
                        <input class="form-input" type="text" id="licenseID" name="licenseID" required>
                        <p id="errorLicenseID"></p>
                    </div>

                    <div>
                        <label for="name">Nombres:</label>
                        <input class="form-input" type="text" id="name" name="name" required>
                        <p id='errorName'></p>
                    </div>

                    <div>
                        <label for="lastName">Apellidos:</label>
                        <input class="form-input" type="text" id="lastName" name="lastName" required>
                        <p id="errorLastName"></p>
                    </div>
                    
                    <div>
                        <label for="email">Correo electrónico:</label>
                        <input class="form-input" type="email" id="email" name="email" required>
                        <p id="errorEmail"></p>
                    </div>

                    <div>
                        <label for="date">Fecha:</label>
                        <input class="form-input" type="date" id="date" name="date" max="2008-06-17" required>
                    </div>

                    <div>
                        <label for="nationality">Nacionalidad:</label>
                        <select class="form-input" id="nationality" name="nationality" required>
                            <option value="venezolano">Venezolano</option>
                            <option value="extranjero">Extranjero</option>
                        </select>
                    </div>

                    <div>
                        <label for="phoneNumber">Telefono:</label>
                        <input class="form-input" type="text" id="phoneNumber" name="phoneNumber" required>
                        <p id="errorPhoneNumber"></p>
                    </div>

                    <div>
                        <label for="address">Direccion:</label>
                        <input class="form-input" type="text" id="address" name="address" required style="width: 100%;">
                        <p id="errorAddress"></p>
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
                        <input class="form-input" id="securityAnswer" name="securityAnswer" type="text" placeholder="Respuesta de Seguridad">
                        <p id='errorAnswer'></p>
                    </div>
                </div>

                <div>
                    <button name="submit" type="submit">Registrarse</button>
                </div>

                <!-- Links -->
                <p><b>¿Olvidaste tu contraseña?<a href="recuperarPassword.php"> Haz clic aquí</a>.</b></p>
                <p><b>¿Ya tienes una cuenta?<a href="iniciarSesion.php"> Haz clic aquí</a>.</b></p>
                <p><b><a href="../../index.php">Volver a Home</a>.</b></p>
            </form>
        </div>
    </main>
    <script type="module" src="./../../assets/js/gestionarAcceso/registrarEstudiantes.js"></script>
</body>
</html>