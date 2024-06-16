<?php
    $_title = "Iniciar Sesion";
    include('../templates/head.php');
?>

<body>

    <main class="main-login">
        <div class="form-container_login">

            <div>
                <img src="../../assets/img/logo.png" alt="Icono del Sistema">
                <div class="login-titles">
                    <h1>Bienvenido al Sistema de Nuevo Ingreso</h1>
                    <p>Ingresa tu correo y clave para acceder al sistema.</p>
                </div>
            </div>

            <form id="form" action="../../controllers/gestionarAcceso/iniciarSesion.php" method="post">
                <div>
                    <label for="email">Correo:</label><br>
                    <input class="form-input" type="text" id="email" name="email" required><br>
                </div>
                
                <div>
                    <label for="password">Contraseña:</label><br>
                    <input class="form-input" type="password" id="password" name="password" required><br>
                </div>

                <div>
                    <button name="submit" type="submit">Iniciar Sesion</button>
                </div>
                
                <p><b>¿No tienes una cuenta?<a href="registrarEstudiantes.php"> Haz clic aquí</a>.</b></p>
                <p><b>¿Se te ha olvidado la contraseña?<a href="recuperarPassword.php"> Haz clic aquí</a>.</b></p>
                <p><b><a href="../../index.php">Volver a Home</a>.</b></p>
            </form>

        </div>
    </main>

    <script src="../../assets/js/gestionarAcceso/iniciarSesion.js"></script>
</body>
</html>
