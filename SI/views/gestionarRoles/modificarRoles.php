<?php
include_once('../../controllers/clases/rol.php');
$roleID = $_GET['id'];
$role = new Role();
$roleDetails = $role->getRoleByID($roleID);
?>

<?php
$title = "Modificar Rol";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2>Modificar Rol</h2>

        <form id="form" action="../../controllers/gestionarRoles/modificarRoles.php?id=<?=$roleID?>" method="post">
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?=$roleDetails['name']?>">
            </div>

            <!-- Descripcion -->
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" id="description" name="description" value="<?=$roleDetails['description']?>">
            </div>

            <!-- Enviar -->
            <input type="submit" value="Guardar Cambios">
        </form>
        
    </div>

    <script src="../../assets/js/gestionarRoles/modificarRoles.js"></script>
</body>
</html>
