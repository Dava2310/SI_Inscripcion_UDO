<?php

include_once('../../controllers/clases/estudiante.php');

$studentID = $_GET['id'];
$student = new Student();
$studentDetails = $student->getStudentByID($studentID);

?>

<?php
$_title = "Modificar Estudiante";
include('../templates/encabezadoConfig.php');
?>


<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <h2>Modificar Estudiante</h2>
        <form id="form" action="../../controllers/gestionarEstudiantes/modificarEstudiante.php?id=<?=$studentID?>" method="post">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?=$studentDetails['name']?>">
            </div>
            <div class="form-group">
                <label for="lastName">Apellido:</label>
                <input type="text" id="lastName" name="lastName" value="<?=$studentDetails['lastName']?>">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?=$studentDetails['email']?>">
            </div>
            <div class="form-group">
                <label for="licenseID">Cedula:</label>
                <input type="text" id="licenseID" name="licenseID" value="<?=$studentDetails['licenseID']?>">
            </div>
            <div class="form-group">
                <label for="phoneNumber">Teléfono:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?=$studentDetails['phoneNumber']?>">
            </div>
            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" value="<?=$studentDetails['address']?>">
            </div>
            <input type="submit" value="Guardar Cambios">
            <button type="button" id="delete">Eliminar Estudiante</button>
        </form>
        
    </div>
    <script src="../../assets/js/gestionarEstudiantes/modificarEstudiante.js"></script>
</body>

</html>