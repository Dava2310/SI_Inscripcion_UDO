<?php
    $_title = "Registro de Estudiante";
    include('../templates/formularioRegistro.php');
?>

<body>
<form id="form" action="../../controllers/gestionarAcceso/registrarEstudiantes.php" method="post" enctype="application/x-www-form-urlencoded">
        <h1>Registro de Estudiante</h1>
        <div class="grid-container">
            <div class="form-group">
                <label for="cedula">Cedula:</label>
                <input type="text" id="licenseID" name="licenseID" required>
                <p id="errorLicenseID"></p>
            </div>
            <div class="form-group">
                <label for="name">Nombres:</label>
                <input type="text" id="name" name="name" required>
                <p id='errorName'></p>
            </div>
            <div class="form-group">
                <label for="lastName">Apellidos:</label>
                <input type="text" id="lastName" name="lastName" required>
                <p id="errorLastName"></p>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
                <p id="errorEmail"></p>
            </div>
            <div class="form-group">
                <label for="date">Fecha:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
            <label for="nationality">Nacionalidad:</label>
                <select id="nationality" name="nationality" required>
                    <option value="venezolano">Venezolano</option>
                    <option value="extranjero">Extranjero</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Telefono:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" required>
                <p id="errorPhoneNumber"></p>
            </div>
            <div class="form-group full-width">
                <label for="address">Direccion:</label>
                <input type="text" id="address" name="address" required style="width: 100%;">
                <p id="errorAddress"></p>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <p id="errorPassword"></p>
            </div>
            <div class="form-group">
                <label for="repassword">Confirme su contraseña:</label>
                <input type="password" id="repassword" name="repassword" required>
                <p id="errorRepassword"></p>
            </div>
            <div class="form-group">
                <label for="securityQuestion">Pregunta de Seguridad</label>
                <select id="securityQuestion" name="securityQuestion">
                    <option value="¿Cuál es tu color favorito?">¿Cuál es tu color favorito?</option>
                    <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                    <option value="¿Cuál es el nombre de tu mascota?">¿Cuál es el nombre de tu mascota?</option>
                    <option value="¿Cuál es tu película favorita?">¿Cuál es tu película favorita?</option>
                </select>
            </div>
            <div class="form-group">
                <label for="securityAnswer">Respuesta de Seguridad</label>
                <input id="securityAnswer" name="securityAnswer" type="text" placeholder="Respuesta de Seguridad">
                <p id='errorAnswer'></p>
            </div>
        </div>
        <input type="submit" value="Registrarse">
    </form>

    <script type="module" src="./../../assets/js/gestionarAcceso/registrarEstudiantes.js"></script>
</body>
</html>
