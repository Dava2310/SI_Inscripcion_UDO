<?php
$_title = "Iniciar Sesion";
include('../templates/encabezadoConfig.php');
?>

<body>
    <form id="form" action="../../controllers/gestionarAcceso/iniciarSesion.php" method="post">
        <h1>Iniciar Sesión</h1>

        <label for="email">Correo:</label><br>
        <input type="text" id="email" name="email" required><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Iniciar Sesión">
        
        <p>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</p>
        <p>¿Se te ha olvidado la contraseña?<a href="recuperarPassword.php"> Haz clic aquí</a>.</p>
    </form>

    <script src="../../assets/js/gestionarAcceso/iniciarSesion.js"></script>
</body>
</html>
