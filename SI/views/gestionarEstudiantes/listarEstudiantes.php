<?php

$_title = "Gestion de Estudiantes";
include ('./../templates/head.php');

// Inicio de la Sesion
session_start();
$id = $_SESSION['ID'];
$idRole = $_SESSION['ID_ROLE'];

// Si no existe una id en la $_SESSION, es porque no esta autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesion');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Incluir el archivo con la definición de la clase Student
include_once ('../../controllers/clases/estudiante.php');

// Crear una instancia de la clase Student
$student = new Student();

// Obtener la lista de estudiantes
$students = $student->getStudents();
?>


<body>
    <div class="main-container">
        <?php

        if ($idRole === 1) {
            include ('../templates/menus/menuAdministrador.php');
        } else {
            include ('../templates/menus/menuEmpleado.php');
        }
        ?>

        <main>
            <div class="info-container">
                <h1>Buscar Estudiante</h1>
                <form action="">

                    <div class="search-container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>
                </form>

                <h1 style="margin-top: 20px;">Lista de Estudiantes</h1>
                <div class="tabla-container" style="margin-top: 10px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!($students)) {
                                echo "<tr><td colspan='6'>No hay estudiantes disponibles</td></tr>";
                            } else {
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
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarEstudiantes/listarEstudiantes.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>