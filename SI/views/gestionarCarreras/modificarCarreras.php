<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/carrera.php');

// Obtener la ID del estudiante
$careerID = $_GET['id'];

// Crear una instancia de la clase Student
$career = new Career();

// Obtener la lista de estudiantes
$careerDetails = $career->getCareerByID($careerID);
?>

<?php
$title = "Modificar Carrera";
include('../templates/encabezadoConfig.php');
?>


<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <h2>Modificar Carrera</h2>
        <form id="form" action="../../controllers/gestionarCarreras/modificarCarreras.php?id=<?=$careerID?>" method="post">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value=<?=$careerDetails['name']?>>
            </div>
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" id="description" name="description" value=<?=$careerDetails['description']?>>
            </div>
            <input type="submit" value="Guardar Cambios">
            <button type="button" id="delete">Eliminar Carrera</button>
        </form>
        
    </div>
    <script src="../../assets/js/gestionarCarreras/modificarCarreras.js"></script>
</body>

</html>