<?php
    $_title = "Recuperar Contraseña";
    include('../templates/formularioRegistro.php');
?>

<body>
    <form id="form" action="">
    <h1>Recupera tu contraseña</h1>
        <div class="grid-container">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="Ingresa tu correo electrónico">
                <p id="errorEmail"></p>
            </div>
            <div class="form-group">
                <label for="securityQuestion">Pregunta de Seguridad</label>
                <select id="securityQuestion" name="securityQuestion">
                    <option value="¿Cuál es tu color favorito?">¿Cuál es tu color favorito?</option>
                    <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                    <option value="¿Cuál es el nombre de tu mascota?">¿Cuál es el nombre de tu mascota?</option>
                    <option value="¿Cuál es tu película favorita?">¿Cuál es tu película favorita?</option>
                </select>
            </div>
            <div class="form-group">
                <label for="securityAnswer">Respuesta de seguridad:</label>
                <input type="text" id="securityAnswer" name="securityAnswer" required placeholder="Ingresa la respuesta">
                <p id="errorEmail"></p>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <p id="errorPassword"></p>
            </div>
            <div class="form-group">
                <label for="repassword">Confirme su contraseña:</label>
                <input type="password" id="repassword" name="repassword" required>
                <p id="errorRepassword"></p>
            </div>

            <input hidden readonly type="text" id="ID" name="ID">

        </div>
        <input type="submit" value="Aceptar">
        <p>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</p>
        <p>¿Ya tienes una cuenta?<a href="iniciarSesion.php"> Haz clic aquí</a>.</p>
    </form>

    <script type="module" src="./../../assets/js/gestionarAcceso/recuperarPassword2.js"></script>
</body>
