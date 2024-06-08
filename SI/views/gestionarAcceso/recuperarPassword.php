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
        </div>
        <input type="submit" value="Aceptar">
        <p>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</p>
    </form>

    <script type="module" src="./../../assets/js/gestionarAcceso/recuperarPassword.js"></script>
</body>

