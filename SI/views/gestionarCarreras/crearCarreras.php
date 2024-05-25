<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/carrera.php');

?>

<?php
$title = "Crear Carrera";
include('../templates/encabezadoConfig.php');
?>


<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <h2>Crear Carrera</h2>
        <form id="form" action="../../controllers/gestionarCarreras/crearCarreras.php" method="post">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" >
            </div>
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" id="description" name="description">
            </div>
            
            <input type="submit" value="Crear Carrera">
        </form>
        
    </div>
    <script src="../../assets/js/gestionarCarreras/crearCarreras.js"></script>
</body>

</html>