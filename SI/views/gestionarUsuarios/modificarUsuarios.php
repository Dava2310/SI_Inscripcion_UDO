<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/usuario.php');

// Obtener la ID del estudiante
$userID = $_GET['id'];

// Crear una instancia de la clase Student
$user = new Usuario();

// Obtener la lista de estudiantes
$userDetails = $user->getUserByID($userID);
?>

<?php
$title = "Modificar Empleado";
include('../templates/encabezadoConfig.php');
?>


<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <h2>Modificar Estudiante</h2>
        <form id="form" action="../../controllers/gestionarUsuarios/modificarUsuarios.php?id=<?=$userID?>" method="post">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value=<?=$userDetails['name']?>>
            </div>
            <div class="form-group">
                <label for="lastName">Apellido:</label>
                <input type="text" id="lastName" name="lastName" value=<?=$userDetails['lastName']?>>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value=<?=$userDetails['email']?>>
            </div>
            <div class="form-group">
                <label for="licenseID">Cedula:</label>
                <input type="text" id="licenseID" name="licenseID" value=<?=$userDetails['licenseID']?>>
            </div>
            <input type="submit" value="Guardar Cambios">
            <button type="button" id="delete">Eliminar Empleado</button>
        </form>
        
    </div>
    <script src="../../assets/js/gestionarUsuarios/modificarUsuarios.js"></script>
</body>

</html>