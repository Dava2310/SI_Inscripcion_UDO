<?php
    $_title = "Recuperar Contraseña";
    include('../templates/encabezadoConfig.php');
?>

<body>
    <form id="form" action="../../controllers/gestionarAcceso/recuperarPassword.php" method="post">
        <h1>Recupera tu contraseña</h1>
        <div class="grid-container">

            <!-- Correo -->
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
                <p id="errorEmail"></p>
            </div>

            <!-- Pregunta Seguridad -->
            <div class="form-group">
                <label for="securityQuestion">Pregunta de Seguridad</label>
                <select id="securityQuestion" name="securityQuestion" required>
                    <option value="Color Favorito">¿Cuál es tu color favorito?</option>
                    <option value="Comida Favorita">¿Cuál es tu comida favorita?</option>
                    <option value="Nombre de mascota">¿Cuál es el nombre de tu mascota?</option>
                    <option value="Pelicula favorita">¿Cuál es tu película favorita?</option>
                </select>
            </div>

            <!-- Respuesta Seguridad -->
            <div class="form-group">
                <label for="securityAnswer">Respuesta de seguridad:</label>
                <input type="text" id="securityAnswer" name="securityAnswer" required placeholder="Ingresa la respuesta">
                <p id="errorSecurityAnswer"></p>
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <p id="errorPassword"></p>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="repassword">Confirme su contraseña:</label>
                <input type="password" id="repassword" name="repassword" required>
                <p id="errorRepassword"></p>
            </div>
            <input type="hidden" id="ID" name="ID">
        </div>

        <!-- Enviar -->
        <input type="submit" value="Aceptar">
        
        <p>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</p>
        <p>¿Ya tienes una cuenta?<a href="iniciarSesion.php"> Haz clic aquí</a>.</p>
    </form>

    <script type="module" src="./../../assets/js/gestionarAcceso/recuperarPassword2.js"></script>
</body>
</html>
