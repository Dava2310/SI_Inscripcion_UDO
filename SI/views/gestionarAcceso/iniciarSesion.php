<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="../../assets/css/global.css"/>
</head>
<body>
    <form id="form" action="../../controllers/gestionarAcceso/iniciarSesion.php" method="post">
        <h1>Iniciar Sesión</h1>
        <label for="email">Correo:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <script src="../../assets/js/gestionarAcceso/iniciarSesion.js"></script>
</body>
</html>
