<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="../../assets/css/global.css"/>
</head>
<<<<<<< HEAD
<body>
    <form id="form" action="../../controllers/gestionarAcceso/iniciarSesion.php" method="post">
        <h1>Iniciar Sesión</h1>
        <label for="email">Correo:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
=======
<>

    <!-- Los unicos datos con los que se valida es el Email y el Passsword -->

    <h2>Iniciar Sesión</h2>
    <form id="form" action="../../controllers/acceso/IniciarSesion.php" method="post">
        <label for="cedula">Cedula:</label><br>
        <input type="text" id="username" name="cedula" required><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br>
>>>>>>> 902fde0f974c1ed733d65a04c888e6d004643c1c
        <input type="submit" value="Iniciar Sesión">
    </form>

    <script src="../../assets/js/gestionarAcceso/iniciarSesion.js"></script>
</body>
</html>
