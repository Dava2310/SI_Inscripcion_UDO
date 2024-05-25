<?php
    $_titulo = "Inicio";
    include('../templates/encabezadoConfig.php');
?>

<body>
    <form id="form" action="../../controllers/gestionarAcceso/registrarEstudiantes.php" method="post" enctype="application/x-www-form-urlencoded">
        <h1>Registro de Estudiante</h1>
        <!-- Campos estudiante  -->
        <label for="name">Nombres:</label>
        <input type="text" id="name" name="name" required>

        <label for="lastName">Apellidos:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="cedula">Cedula:</label>
        <input type="text" id="licenseID" name="licenseID" required>

        <label for="phoneNumber">Telefono:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required>

        <label for="address">Direccion:</label>
        <input type="text" id="address" name="address" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Registrarse">
    </form>

    <script src="./../../assets/js/gestionarAcceso/registrarEstudiantes.js"></script>
</body>
</html>
