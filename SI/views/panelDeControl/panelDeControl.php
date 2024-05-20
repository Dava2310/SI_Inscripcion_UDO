<?php
    $_titulo = "Inicio";
    include('../templates/registros.php');
?>

<body>
    <div class="hero">
        <h1>Bienvenido al proceso de inscripción</h1>
        <p>Elige una opción:</p>
        <a href="./procesoInscripcion/registroOPSU.php" class="btn">OPSU</a>
        <a href="./procesoInscripcion/registroRUSI.php" class="btn">RUSI</a>
        <a href="./procesoInscripcion/registroConvenio.php" class="btn">Convenio</a>
        <a href="/views/acceso/cerrarSesion.php" class="btn">Cerrar Sesion</a>
    </div>
</body>
</html>