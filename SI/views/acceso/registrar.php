<?php
    $_titulo = "Inicio";
    include('./../templates/registros.php');
?>

<body>
    <h1>Registro de Estudiante Universitario</h1>
    <form id="form" action="../../controllers/acceso/registrar.php" method="post">

        <!-- Campos estudiante  -->

        <label for="primerNombre">Primer nombre:</label>
        <input type="text" id="primerNombre" name="primerNombre" required>

        <label for="segundoNombre">Segundo Nombre:</label>
        <input type="text" id="segundoNombre" name="segundoNombre" required>

        <label for="primerApellido">Primer Apellido:</label>
        <input type="text" id="primerApellido" name="primerApellido" required>

        <label for="segundoApellido">Segundo Apellido:</label>
        <input type="text" id="segundoApellido" name="segundoApellido" required>

        <label for="cedula">Cedula:</label>
        <input type="text" id="cedula" name="cedula" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <input type="submit" value="Registrarse">
    </form>

    <script src="../../assets/js/acceso/registrar.js"></script>
</body>
</html>
