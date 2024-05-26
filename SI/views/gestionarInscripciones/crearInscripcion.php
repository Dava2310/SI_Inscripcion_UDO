<?php
$title = "Panel De Control";
include('./../templates/encabezadoConfig.php');
?>

<body>
    <?php include("./../templates/menus/menuEstudiante.php") ?>
    <div class="content">
        <div class="form-inscription">
            <form>
                <label for="process" class="form-label">Selecciona tu proceso de Inscripción:</label>
                <select id="process" name="process" class="form-select">
                    <option value="">Selecciona una opcion</option>
                    <option value="opsu">OPSU</option>
                    <option value="convenio">Convenio</option>
                    <option value="rusi">RUSI</option>
                </select>

                <h1 class="form-header">Documentos Recaudados</h1>

                <div class="documents">
                    <div>
                        <label for="cedula-upload" class="custom-file-upload">
                            Subir Cédula
                        </label>
                        <input id="cedula-upload" type="file" class="form-input" />
                    </div>

                    <div>
                        <label for="notas-upload" class="custom-file-upload">
                            Subir Notas Certificadas
                        </label>
                        <input id="notas-upload" type="file" class="form-input" />
                    </div>

                    <div>
                        <label for="titulo-upload" class="custom-file-upload">
                            Subir Título de Bachiller
                        </label>
                        <input id="titulo-upload" type="file" class="form-input" />
                    </div>

                    <div>
                        <label for="partida-upload" class="custom-file-upload">
                            Subir Partida de Nacimiento
                        </label>
                        <input id="partida-upload" type="file" class="form-input" />
                    </div>

                    <div>
                        <label for="planilla-upload" class="custom-file-upload">
                            Subir Planilla OPSU
                        </label>
                        <input id="planilla-upload" type="file" class="form-input" />
                    </div>
                </div>
                <div>
                    <h2>Observacion</h2>
                    <textarea class="description" name="description" placeholder="Escribe una observacion para enviar a control de estudios"></textarea>
                </div>


                <button type="submit" class="form-button">Enviar</button>
                <button type="submit" class="form-button">Deshacer todo</button>
            </form>
        </div>
    </div>
    <script src="../../assets/js/gestionarInscripciones/crearInscripcion.js"></script>
</body>

</html>