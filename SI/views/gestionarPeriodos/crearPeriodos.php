<?php
include_once('../../controllers/clases/periodo.php');
?>

<?php
$_title = "Crear Periodo";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2>Crear Periodo</h2>

        <form id="form" action="../../controllers/gestionarPeriodos/crearPeriodos.php" method="post">

            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name">
                <span id="nameError" class="error"></span>
            </div>

            <!-- Fecha de Inicio -->
            <div class="form-group">
                <label for="dateStart">Fecha de Inicio:</label>
                <input type="date" id="dateStart" name="dateStart">
                <span id="dateStartError" class="error"></span>
            </div>

            <!-- Fecha de Fin -->
            <div class="form-group">
                <label for="dateEnd">Fecha de Fin:</label>
                <input type="date" id="dateEnd" name="dateEnd">
                <span id="dateEndError" class="error"></span>
            </div>

            <!-- Enviar -->
            <input type="submit" value="Crear Periodo">
        </form>
    </div>
    <script src="../../assets/js/gestionarPeriodos/crearPeriodos.js"></script>
</body>

</html>
