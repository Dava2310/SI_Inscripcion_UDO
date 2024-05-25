<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/usuario.php');

?>

<?php
$title = "Crear Usuario";
include('../templates/encabezadoConfig.php');
?>


<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <h2>Crear Empleado</h2>
        <form id="form" action="../../controllers/gestionarUsuarios/crearUsuarios.php" method="post">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" >
            </div>
            <div class="form-group">
                <label for="lastName">Apellido:</label>
                <input type="text" id="lastName" name="lastName">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" >
            </div>
            <div class="form-group">
                <label for="licenseID">Cedula:</label>
                <input type="text" id="licenseID" name="licenseID">
            </div>
            
            <input type="submit" value="Crear Empleado">
        </form>
        
    </div>
    <script src="../../assets/js/gestionarUsuarios/crearUsuarios.js"></script>
</body>

</html>