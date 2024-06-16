<?php
// Incluir el archivo con la definición de la clase Student
include_once('../../controllers/clases/estudiante.php');

// Crear una instancia de la clase Student
$student = new Student();

// Obtener la lista de estudiantes
$students = $student->getStudents();
?>

<?php
$_title = "Panel De Control";
include('../templates/encabezadoConfig.php');
?>

<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>
    <div class="content">
        <div>
            <div class="tools">
                <div class="searchBar">
                    <input id="searchInput" placeholder="Buscar" />
                </div>
                
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer la lista de estudiantes y mostrar su información en filas de la tabla
                    foreach ($students as $student) {
                        echo <<<HTML
                        <tr class="dataList">
                            <td>{$student['name']}</td>
                            <td>{$student['lastName']}</td>
                            <td>{$student['licenseID']}</td>
                            <td>{$student['email']}</td>
                            <td>{$student['state']}</td>
                            <td><a href="modificarEstudiante.php?id={$student['ID']}">Modificar</a></td>
                        </tr>
                        HTML;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../../assets/js/gestionarEstudiantes/listarEstudiantes.js"></script>
</body>

</html>