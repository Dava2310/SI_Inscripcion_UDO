<?php
include_once('../../controllers/clases/carrera.php');

$careerID = $_GET['id'];
$career = new Career();
$careerDetails = $career->getCareerByID($careerID);
?>

<?php
$_title = "Modificar Carrera";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2>Modificar Carrera</h2>

        <form id="form" action="../../controllers/gestionarCarreras/modificarCarreras.php?id=<?= $careerID ?>" method="post">
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?= $careerDetails['name'] ?>">
            </div>

            <!-- descripcion -->
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" id="description" name="description" value="<?= $careerDetails['description'] ?>">
            </div>

            <!-- Codigo -->
            <div class="form-group">
                <label for="description">Codigo:</label>
                <input type="text" id="code" name="code" value="<?= $careerDetails['code'] ?>">
            </div>

            <!-- Enviar -->
            <input type="submit" value="Guardar Cambios">
            <button type="button" id="delete">Eliminar Carrera</button>
        </form>

    </div>
    <script src="../../assets/js/gestionarCarreras/modificarCarreras.js"></script>
</body>

</html>