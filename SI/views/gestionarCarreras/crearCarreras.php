<?php
include_once('../../controllers/clases/carrera.php');
?>

<?php
$title = "Crear Carrera";
include('../templates/encabezadoConfig.php');
?>


<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2>Crear Carrera</h2>

        <form id="form" action="../../controllers/gestionarCarreras/crearCarreras.php" method="post">

            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" >
            </div>

            <!-- Descripcion -->
            <div class="form-group">
                <label for="description">Descripcion:</label>
                <input type="text" id="description" name="description">
            </div>

            <!-- Codigo -->
            <div class="form-group">
                <label for="code">Codigo:</label>
                <input type="text" id="code" name="code">
            </div>

            <!-- Enviar -->
            <input type="submit" value="Crear Carrera">
        </form>
        
    </div>
    <script src="../../assets/js/gestionarCarreras/crearCarreras.js"></script>
</body>

</html>