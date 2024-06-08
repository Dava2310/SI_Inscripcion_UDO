<?php

/**
 * Clase Inscription
 * 
 * Esta clase representa una inscripción en el sistema.
 */
include_once(__DIR__ . '/../conexion.php');

class Inscription
{

    private $con;

    /**
     * Constructor de la clase Inscription
     * 
     * Crea una nueva instancia de la clase Inscription y establece la conexión a la base de datos.
     */
    public function __construct()
    {
        // Incluir la conexion a base de datos
        $this->con = Connection::getInstance()->getConnection();
    }

    public function registerInscriptionPhaseOne($idStudent, $insDate, $idState, $inscriptionPhase, $opsuCode, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("INSERT INTO inscriptions (idStudent, date, idState, inscriptionPhase, opsuCode, gradePointAverage, degreeCode, campusAddress, graduationYear, degreeTitle) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isissdssss", $idStudent, $insDate, $idState, $inscriptionPhase, $opsuCode, $gradePointAverage, $degreeCode, $campusAddress, $graduationYear, $degreeTitle);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al crear la inscripción');
            exit;
        }

        // Verificación de filas afectadas para determinar si la inscripción se creó correctamente
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getInscriptionByStudentId($idStudent)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT ID FROM inscriptions WHERE idStudent = ?");
        $stmt->bind_param("i", $idStudent);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al buscar la inscripción');
            exit;
        }

        // Obtener los resultados
        $result = $stmt->get_result();

        // Verificar si se encontró alguna inscripción
        if ($result->num_rows > 0) {
            // Devolver el ID de la inscripción
            $row = $result->fetch_assoc();
            return $row['ID'];
        } else {
            return false;
        }
    }







    public function approveInscriptionInPhase($inscriptionId, $phase)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("UPDATE inscriptions SET idState=1, inscriptionPhase = ? WHERE ID = ?");
        $stmt->bind_param("ii", $phase, $inscriptionId);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al actualizar los datos de la inscripción');
            exit;
        }

        // Verificación de si se actualizó algún registro
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function unapproveInscriptionInPhase($inscriptionId)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("UPDATE inscriptions SET idState = 2 WHERE ID = ?");
        $stmt->bind_param("i", $inscriptionId);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al actualizar los datos de la inscripción');
            exit;
        }

        // Verificación de si se actualizó algún registro
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }













    /**
     * Crear Inscripción
     *
     * Crea una nueva inscripción en la base de datos con los datos proporcionados.
     *
     * @param int $idStudent El ID del estudiante.
     * @param string $insDate La fecha de inscripción.
     * @param string $insState El estado de la inscripción.
     * @param string $insDescription La descripción de la inscripción.
     * 
     * @return bool Retorna true si la inscripción se creó correctamente en la base de datos, de lo contrario retorna false.
     */
    public function registerInscription($idStudent, $insDate, $insState, $idProcess, $insUrl, $insDescription)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("INSERT INTO inscriptions (idStudent, date, idState, idProcess, url, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiss", $idStudent, $insDate, $insState, $idProcess, $insUrl, $insDescription);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al crear la inscripción');
            exit;
        }

        // Verificación de filas afectadas para determinar si la inscripción se creó correctamente
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtener Inscripciones
     *
     * Obtiene los datos de todas las inscripciones registradas en la base de datos.
     *
     * @return array|bool Retorna un array con los datos de las inscripciones si hay registros, de lo contrario retorna false.
     */
    public function getInscriptions()
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT students.name AS studentName, students.lastName, students.licenseID, students.email, inscriptions.ID, inscriptions.date, inscriptionStates.name AS state, inscriptions.inscriptionPhase FROM students JOIN inscriptions ON students.ID = inscriptions.idStudent JOIN inscriptionStates ON inscriptions.idState = inscriptionStates.ID");

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al obtener las inscripciones');
            exit;
        }

        // Recogiendo los resultados de la query
        $result = $stmt->get_result();

        // Verificando si hay registros
        if ($result->num_rows > 0) {
            $inscripciones = array();

            // Obtener los datos de las inscripciones en un array
            while ($row = $result->fetch_assoc()) {
                $inscripciones[] = $row;
            }

            return $inscripciones;
        } else {
            return false;
        }
    }



    /**
     * Buscar Inscripción por ID
     *
     * Busca una inscripción en la base de datos según su ID de inscripción.
     *
     * @param int $idInscription El ID de la inscripción a buscar.
     * @return array|bool Retorna un array con los datos de la inscripción si se encuentra, de lo contrario retorna false.
     */
    public function getInscriptionByID($idInscription)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * from inscriptions WHERE inscriptions.ID = ?");
        $stmt->bind_param("i", $idInscription);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al buscar la inscripción por ID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró la inscripción
        if ($result->num_rows > 0) {
            $inscripcion = $result->fetch_assoc();
            return $inscripcion;
        } else {
            return false;
        }
    }


    /**
     * Eliminar Inscripción
     *
     * Elimina completamente el registro de una inscripción de la base de datos.
     *
     * @param int $idInscription El ID de la inscripción a eliminar.
     * @return bool Retorna true si la inscripción fue eliminada con éxito, de lo contrario retorna false.
     */
    public function deleteInscriptionByID($idInscription)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("DELETE FROM inscriptions WHERE ID = ?");
        $stmt->bind_param("i", $idInscription);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al eliminar la inscripción');
            exit;
        }

        // Verificación de si se eliminó algún registro
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
