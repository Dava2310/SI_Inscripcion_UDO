<?php
include_once(__DIR__ . '/../conexion.php');

class Inscription
{
    private $con;

    public function __construct()
    {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerInscription($date, $opsuCode, $url, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, $inscriptionPhase, $state, $observations, $validity, $idStudent, $idProcess, $idPeriod)
    {
        $stmt = $this->con->prepare('INSERT INTO inscriptions (date, opsuCode, url, gradePointAverage, degreeCode, campusAddress, graduationYear, degreeTitle, inscriptionPhase, state, observations, validity, idStudent, idProcess, idPeriod) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssdssssissiiii', $date, $opsuCode, $url, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, $inscriptionPhase, $state, $observations, $validity, $idStudent, $idProcess, $idPeriod);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo crear la inscripción.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Leer
    public function getInscriptionByID($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM inscriptions WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar la inscripción por ID: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Actualizar
    public function updateInscription($id, $date, $opsuCode, $url, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, $inscriptionPhase, $state, $observations, $validity, $idStudent, $idProcess, $idPeriod)
    {
        $stmt = $this->con->prepare("UPDATE inscriptions SET date = ?, opsuCode = ?, url = ?, gradePointAverage = ?, degreeCode = ?, campusAddress = ?, graduationYear = ?, degreeTitle = ?, inscriptionPhase = ?, state = ?, observations = ?, validity = ?, idStudent = ?, idProcess = ?, idPeriod = ? WHERE ID = ?");
        $stmt->bind_param('sssdssssissiiiii', $date, $opsuCode, $url, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle, $inscriptionPhase, $state, $observations, $validity, $idStudent, $idProcess, $idPeriod, $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos de la inscripción: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }


    // Borrar
    public function deleteInscriptionById($inscriptionID)
    {
        $stmt = $this->con->prepare("DELETE FROM inscriptions WHERE ID = ?");
        $stmt->bind_param("i", $inscriptionID);

        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar la inscripción: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Listar inscripciones
    public function getInscriptions()
    {
        $stmt = $this->con->prepare("SELECT students.lastName, students.licenseID, students.email, inscriptions.date, inscriptions.state, inscriptions.ID, inscriptions.inscriptionPhase, inscriptionProcesses.name AS process, students.name AS name FROM inscriptions JOIN students ON idStudent = students.ID JOIN inscriptionProcesses ON idProcess = inscriptionProcesses.ID");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener las inscripciones: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $inscriptions = [];

        while ($row = $result->fetch_assoc()) {
            $inscriptions[] = $row;
        }

        return $inscriptions;
    }

    // Otros //

    // Leer por ID de estudiante
    public function getInscriptionByStudentId($studentId)
    {
        $stmt = $this->con->prepare("SELECT * FROM inscriptions WHERE idStudent = ? ORDER BY date DESC LIMIT 1");
        $stmt->bind_param("i", $studentId);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar la inscripción por ID de estudiante: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Ascender a fase 2
    public function levelToInscriptionPhaseTwo($idInscription, $idProcess)
    {
        $newPhase = 2; // Fase a la que se va a ascender

        // Actualizar la fase de la inscripción
        $stmt = $this->con->prepare('UPDATE inscriptions SET observations = "", inscriptionPhase = ?, idProcess = ?, state = "En Revision" WHERE ID = ?');
        $stmt->bind_param('iii', $newPhase, $idProcess, $idInscription);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo actualizar la fase de la inscripción.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Ascender a fase 3
    public function levelToInscriptionPhaseThree($idInscription)
    {
        $newPhase = 3; // Fase a la que se va a ascender

        // Actualizar la fase de la inscripción
        $stmt = $this->con->prepare('UPDATE inscriptions SET inscriptionPhase = ?,  state = "" WHERE ID = ?');
        $stmt->bind_param('ii', $newPhase, $idInscription);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo actualizar la fase de la inscripción.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Rechazar Inscripcion
    public function rejectInscription($idInscription, $observations)
    {
        // Actualizar la fase de la inscripción
        $stmt = $this->con->prepare('UPDATE inscriptions SET state = "A Corregir", observations = ? WHERE ID = ?');
        $stmt->bind_param('si', $observations, $idInscription);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo actualizar la fase de la inscripción.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }
}
