<form form action="../../controllers/gestionarInscripciones/crearInscripciones.php?id=<?= $studentID ?>" method="post">
                <div>
                    <h2>Paso 2 de 3: Seleccionar Carreras</h2>
                </div>
                <label for="process" class="formLabel">Selecciona tu proceso de Inscripción:</label>
                <select id="process" name="process" class="formSelect">
                    <option value="">Selecciona una opcion</option>
                    <option value="1">OPSU</option>
                    <option value="2">RUSI</option>
                    <option value="3">Convenio</option>
                </select>

                <div id="other">
                    <select name="career" class="formSelect">
                    <option value="">Selecciona Carrera</option>
                        <?php
                        foreach ($careers as $career) {
                            echo <<<HTML
                            <option value="">{$career['name']}</option>
                            HTML;
                        }
                        ?>
                    </select>
                    <button type="submit" class="formButton">Enviar</button>
                </div>

                <div id="rusi">
                    <select name="career" class="formSelect">
                        <option value="">Selecciona Carrera #1</option>
                        <?php
                        foreach ($careers as $career) {
                            echo <<<HTML
                            <option value="">{$career['name']}</option>
                            HTML;
                        }
                        ?>
                    </select>
                    <select name="career" class="formSelect">
                        <option value="">Selecciona Carrera #2</option>
                        <?php
                        foreach ($careers as $career) {
                            echo <<<HTML
                            <option value="">{$career['name']}</option>
                            HTML;
                        }
                        ?>
                    </select>
                    <select name="career" class="formSelect">
                        <option value="">Selecciona Carrera #3</option>
                        <?php
                        foreach ($careers as $career) {
                            echo <<<HTML
                            <option value="">{$career['name']}</option>
                            HTML;
                        }
                        ?>
                    </select>
                    <button type="submit" class="formButton">Enviar</button>
                </div>
            </form>