<?php
include_once('../../controllers/clases/periodo.php');

$periodID = $_GET['id'];
$period = new Period();
$periodDetails = $period->getPeriodByID($periodID);
$periodStatus = $periodDetails['validity'];
?>

<?php
$_title = "Modificar Periodo";
include('../templates/encabezadoConfig.php');
?>

<body>
    <!-- Barra lateral -->
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2>Modificar Periodo</h2>

        <form id="form" action="../../controllers/gestionarPeriodos/modificarPeriodos.php?id=<?= $periodID ?>" method="post">

            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?= $periodDetails['name'] ?>">
                <span id="nameError" class="error" style="color: red;"></span>
            </div>

            <!-- Fecha de Inicio -->
            <div class="form-group">
                <label for="dateStart">Fecha de Inicio:</label>
                <input type="date" id="dateStart" name="dateStart" value="<?= $periodDetails['dateStart'] ?>">
                <span id="dateStartError" class="error" style="color: red;"></span>
            </div>

            <!-- Fecha de Fin -->
            <div class="form-group">
                <label for="dateEnd">Fecha de Fin:</label>
                <input type="date" id="dateEnd" name="dateEnd" value="<?= $periodDetails['dateEnd'] ?>">
                <span id="dateEndError" class="error" style="color: red;"></span>
            </div>

            <!-- Enviar -->
            <input id="save" type="submit" value="Guardar Cambios">
            <button type="button" id="delete">Eliminar Periodo</button>
            <button type="button" id="activate">Empezar Periodo</button>
            <button type="button" id="finish">Terminar Periodo</button>
        </form>

    </div>
    <script>
        const periodStatus = <?= $periodStatus ?>;
        const periodID = <?= $periodID?>
    </script>
    <script src="../../assets/js/gestionarPeriodos/modificarPeriodos.js"></script>
</body>

</html>
