<?php
include_once('../../controllers/clases/usuario.php');

$userID = $_GET['id'];
$user = new User();
$userDetails = $user->getUserByID($userID);
?>

<?php
$_title = "Modificar Empleado";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2>Modificar Empleado</h2>

        <form id="form" action="../../controllers/gestionarUsuarios/modificarUsuarios.php?id=<?=$userID?>" method="post">
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?=$userDetails['name']?>">
            </div>

            <!-- Apellido -->
            <div class="form-group">
                <label for="lastName">Apellido:</label>
                <input type="text" id="lastName" name="lastName" value="<?=$userDetails['lastName']?>">
            </div>

            <!-- Correo -->
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?=$userDetails['email']?>">
            </div>

            <!-- Cedula -->
            <div class="form-group">
                <label for="licenseID">Cedula:</label>
                <input type="text" id="licenseID" name="licenseID" value="<?=$userDetails['licenseID']?>">
            </div>

            <!-- Enviar -->
            <input type="submit" value="Guardar Cambios">

            <!-- Eliminar -->
            <button type="button" id="delete">Eliminar Empleado</button>
        </form>
    </div>

    <script src="../../assets/js/gestionarUsuarios/modificarUsuarios.js"></script>
</body>
</html>
