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
    public function registerInscription($idStudent, $insDate, $insState, $idProcess, $insUrl,$insDescription)
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
     * Actualizar Datos de Inscripción
     *
     * Actualiza la fecha, estado y descripción de una inscripción en la base de datos.
     *
     * @param int $idInscription El ID de la inscripción a actualizar.
     * @param string $insDate La nueva fecha de inscripción.
     * @param string $insState El nuevo estado de la inscripción.
     * @param string $insDescription La nueva descripción de la inscripción.
     * @return bool Retorna true si los datos de la inscripción se actualizaron correctamente, de lo contrario retorna false.
     */
    public function updateInscription($idInscription, $insDate, $insState, $insDescription)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("UPDATE inscriptions SET insDate = ?, insState = ?, insDescription = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $insDate, $insState, $insDescription, $idInscription);

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
     * Obtener Inscripciones
     *
     * Obtiene los datos de todas las inscripciones registradas en la base de datos.
     *
     * @return array|bool Retorna un array con los datos de las inscripciones si hay registros, de lo contrario retorna false.
     */
    public function getInscriptions()
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT students.name AS studentName, students.lastName, students.licenseID, students.email, inscriptions.ID, inscriptions.date, inscriptionStates.name AS state FROM students JOIN inscriptions ON students.ID = inscriptions.idStudent JOIN inscriptionStates ON inscriptions.idState = inscriptionStates.ID;");

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
        $stmt = $this->con->prepare("SELECT inscriptions.ID AS ID, inscriptions.date, inscriptionProcesses.name AS process, inscriptions.description from inscriptions JOIN inscriptionProcesses ON inscriptions.idProcess = inscriptionProcesses.ID WHERE inscriptions.ID = ? LIMIT 1");
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
     * Obtener Inscripciones por Estado
     *
     * Obtiene los datos de las inscripciones según su estado.
     *
     * @param string $insState El estado de las inscripciones a obtener.
     * @return array|bool Retorna un array con los datos de las inscripciones si hay registros, de lo contrario retorna false.
     */
    public function getInscriptionsByState($insState)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM inscriptions WHERE insState = ?");
        $stmt->bind_param("s", $insState);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al obtener las inscripciones por estado');
            exit;
        }

        // Recogiendo los resultados de la consulta
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

?>
