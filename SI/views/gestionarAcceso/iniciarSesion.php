<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<>

    <!-- Los unicos datos con los que se valida es el Email y el Passsword -->

    <h2>Iniciar Sesión</h2>
    <form id="form" action="../../controllers/acceso/IniciarSesion.php" method="post">
        <label for="cedula">Cedula:</label><br>
        <input type="text" id="username" name="cedula" required><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <script src="./../../assets/js/acceso/iniciarSesion.js"></script>
</body>
</html>
