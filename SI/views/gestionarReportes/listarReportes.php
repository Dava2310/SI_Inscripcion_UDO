<?php
$_title = "Panel De Reportes";
include('../templates/head.php');
?>

<body>
    <div class="sidebarBackground">
        <?php include('../templates/menus/menuAdministrador.php') ?>
    </div>

    <div class="content">
        <div class="card-grid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title">Título 1</h2>
                    <p class="card-text">Descripción 1</p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title">Título 2</h2>
                    <p class="card-text">Descripción 2</p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title">Título 3</h2>
                    <p class="card-text">Descripción 3</p>
                </div>
            </div>
            <!-- Agrega más tarjetas según sea necesario -->
        </div>
    </div>

</body>

</html>