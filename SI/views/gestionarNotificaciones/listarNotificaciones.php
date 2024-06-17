<?php

$_title = "Gestión de Notificaciones";
include('./../templates/head.php');

// Inicio de la Sesión
session_start();
$id = $_SESSION['ID'];

// Si no existe una id en la $_SESSION, es porque no está autentificado
if (!(isset($id))) {
    echo "<script> window.alert('No ha iniciado sesión');</script>";
    echo "<script> window.location='../gestionarAcceso/iniciarSesion.php'; </script>";
    die();
}

// Incluir el archivo con la definición de la clase Notification
include_once('../../controllers/clases/notificaciones.php');

// Crear una instancia de la clase Notification
$notification = new Notification();

// Obtener la lista de notificaciones
$notifications = $notification->getNotificationsById($id);
$idRole = $_SESSION['ID_ROLE'] ?? null;
?>

<?php
$_title = "Panel De Control";
include('../templates/head.php');
?>

<body>
    <div class="main-container">
        <!-- CONTENIDO DEL MENU DE NAVEGACION -->
        <?php

        if ($idRole) {
            if ($idRole === 1) {
                include('../templates/menus/menuAdministrador.php');
            } else {
                include('../templates/menus/menuEmpleado.php');
            }
        } else {
            include('../templates/menus/menuEstudiante.php');
        }

        ?>
        <main>
            <div class="info-container">
                <h1>Buscar Notificación</h1>
                <form action="">

                    <div class="search-container">
                        <div class="form-input_search">
                            <input id="searchInput" placeholder="Buscar" />
                            <img src="../../assets/img/Union.png" alt="">
                        </div>
                    </div>
                </form>

                <h1 style="margin-top: 20px;">Lista de Notificaciones</h1>
                <div class="tabla-container" style="margin-top: 10px">
                    <table>
                        <thead style="border-bottom: 1px solid #ddd;">
                            <tr>
                                <th style="background-color: white;">Tipo</th>
                                <th style="background-color: white;">Fecha</th>
                                <th style="background-color: white;">Contenido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Recorrer la lista de notificaciones y mostrar su información en filas de la tabla
                            if ($notifications) {
                                foreach ($notifications as $notification) {
                                    $tipo = empty($notification['idStudent']) ? 'Aviso General' : 'Para ti';
                                    echo <<<HTML
                                    <tr class="dataList">
                                        <td style="font-weight: 600; background-color: white;">{$tipo}</td>
                                        <td style="background-color: white;">{$notification['date']}</td>
                                        <td style="text-wrap: wrap; text-overflow: unset; text-align: left; background-color: white;">{$notification['content']}</td>
                                    </tr>
                                    HTML;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="group_buttons">
                    <?php if ($idRole === 1) : ?>
                        <button id="create" type="button">Crear una notificación global</button>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <script src="../../assets/js/gestionarNotificaciones/listarNotificaciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>