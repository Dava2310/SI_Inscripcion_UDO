<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/inscripciones.php');

session_start();

// Crear una instancia de la clase Inscription
$inscription = new Inscription();

// Obtener datos de la inscripccion
$inscriptionId = $_GET['id'];

$inscriptionDetails = $inscription->getInscriptionByID($inscriptionId);
echo $_SESSION['ID'];
?>

<?php
$title = "Panel De Inscripciones";
include('../templates/encabezadoConfig.php');
?>

<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <div class="form-inscription">
            <form id="form" action="../../controllers/gestionarInscripciones/consultarInscripcionPasoUno.php?id=<?=$inscriptionId?>" method="post">
                <div>
                    <h2>Paso 1 de 3: Revision Datos basicos</h2>
                </div>
                <div>
                    <label for="opsuCode">Codigo de Opsu</label>
                    <input type="text" name="opsuCode" disabled value=<?= $inscriptionDetails['opsuCode'] ?> />
                </div>
                <div>
                    <label for="degreeCode">Codigo de titulo</label>
                    <input type="text" name="degreeCode" disabled value=<?= $inscriptionDetails['degreeCode'] ?> />
                </div>
                <div>
                    <label for="campusAddress">Direccion Plantel</label>
                    <input type="text" name="campusAddress" disabled value=<?= $inscriptionDetails['campusAddress'] ?> />
                </div>
                <div>
                    <label for="graduationYear">Año de graduacion</label>
                    <input type="text" name="graduationYear" disabled value=<?= $inscriptionDetails['date'] ?> />
                </div>
                <div>
                    <label for="degreeTitle">Nombre del titulo</label>
                    <input type="text" name="degreeTitle" disabled value=<?= $inscriptionDetails['degreeTitle'] ?> />
                </div>
                <div>
                    <label for="gradePointAverage">Promedio</label>
                    <input type="text" name="gradePointAverage" placeholder="0.000" disabled value=<?= $inscriptionDetails['gradePointAverage'] ?> />
                </div>

                <button id="approveButton" type="submit" class="formButton">Aprobar</button>
                <button id="rejectButton" type="submit" class="formButton">Rechazar</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/consultarInscripcionPasoUno.js"></script>
</body>

</html>