<?php
// Título de la página
$_titulo = "Inicio";
// Incluir archivo de encabezado y registros
include('../templates/registros.php');
?>

<body>
    <!-- Encabezado -->
    <h1>Registro de Usuarios</h1>
    <!-- Formulario de registro -->
    <form id="form" action="../../../controllers/acceso/registrar.php" method="post">

        <!-- Campos para el registro -->

        <label for="name">Nombres:</label>
        <input type="text" id="name" name="name" required>

        <label for="lastName">Apellidos:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="licenseID">Cedula:</label>
        <input type="text" id="licenseID" name="licenseID" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="idRole">Rol</label>
        <select class="formInput" id="idRole" name="idRole">
            <!-- Opciones para el rol -->
            <option value="1">Asistente de Control de Estudios</option>
            <option value="2">Estudiante</option>
        </select>

        <input type="submit" value="Registrarse">
    </form>

    <!-- Script JavaScript -->
    <script src="../../assets/js/gestionarUsuarios/registrar.js"></script>
</body>
</html>
