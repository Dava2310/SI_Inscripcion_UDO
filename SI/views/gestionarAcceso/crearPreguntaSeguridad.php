<?php
    $_title = "Registro de Estudiante";
    include('../templates/encabezadoConfig.php');
?>

<body>
<form id="form" action="../../controllers/gestionarAcceso/crearPreguntaSeguridad.php" method="post" enctype="application/x-www-form-urlencoded">
        <h1>Crear Pregunta Seguridad</h1>

        <div class="grid-container">

            <!-- Contraseña nueva -->
            <div class="form-group">
                <label for="password">Contraseña nueva:</label>
                <input type="password" id="password" name="password" required>
                <p id="errorPassword"></p>
            </div>

            <!-- Repetir Contraseña -->
            <div class="form-group">
                <label for="repassword">Confirme su nueva contraseña:</label>
                <input type="password" id="repassword" name="repassword" required>
                <p id="errorRepassword"></p>
            </div>

            <!-- Pregunta Seguridad -->
            <div class="form-group">
                <label for="securityQuestion">Pregunta de Seguridad</label>
                <select id="securityQuestion" name="securityQuestion">
                <option value="Color Favorito">¿Cuál es tu color favorito?</option>
                    <option value="Comida Favorita">¿Cuál es tu comida favorita?</option>
                    <option value="Nombre de mascota">¿Cuál es el nombre de tu mascota?</option>
                    <option value="Pelicula favorita">¿Cuál es tu película favorita?</option>
                </select>
            </div>

            <!-- Respuesta Seguridad -->
            <div class="form-group">
                <label for="securityAnswer">Respuesta de Seguridad</label>
                <input id="securityAnswer" name="securityAnswer" type="text" placeholder="Respuesta de Seguridad">
                <p id='errorAnswer'></p>
            </div>
        </div>

        <!-- Enviar -->
        <input type="submit" value="Registrarse">
    </form>

    <script type="module" src="./../../assets/js/gestionarAcceso/crearPreguntaSeguridad.js"></script>
</body>
</html>
