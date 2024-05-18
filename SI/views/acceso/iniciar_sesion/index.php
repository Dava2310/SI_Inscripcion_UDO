<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="procesar_login.php" method="post">
        <label for="username">Nombre de usuario:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
