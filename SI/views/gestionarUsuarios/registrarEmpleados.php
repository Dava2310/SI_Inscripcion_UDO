<?php
    $_titulo = "Inicio";
    include('../templates/registros.php');
?>

<body>
    <h1>Registro de Usuarios</h1>
    <form id="form" action="../../../controllers/acceso/registrar.php" method="post">

        <!-- Campos estudiante  -->

        <label for="name">Nombres:</label>
        <input type="text" id="name" name="name" required>

        <label for="lastName">Apellidos:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="cedula">Cedula:</label>
        <input type="text" id="licenseID" name="licenseID" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="idRole">Rol</label>
        <select class="formInput" id="idRole" name="idRole">
            <option value="1">Asistente de Control de Estudios</option>
            <option value="2">Estudiante</option>
        </select>

        <input type="submit" value="Registrarse">
    </form>

    <script src="../../assets/js/gestionarUsuarios/registrar.js"></script>
</body>
</html>
