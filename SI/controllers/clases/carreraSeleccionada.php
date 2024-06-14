<?php
include_once(__DIR__ . '/../conexion.php');

class SelectedCareer {
    private $con;

    public function __construct() {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerSelectedCareer($idInscription, $idCareer, $idPeriod) {
        $stmt = $this->con->prepare('INSERT INTO selectedCareers(idInscription, idCareer, idPeriod) VALUES (?, ?, ?)');
        $stmt->bind_param('iii', $idInscription, $idCareer, $idPeriod);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo crear la carrera seleccionada.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Leer
    public function getSelectedCareerByID($id) {
        $stmt = $this->con->prepare("SELECT * FROM selectedCareers WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar la carrera seleccionada por ID: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Actualizar
    public function updateSelectedCareerById($idSelectedCareer, $idCareer) {
        $stmt = $this->con->prepare("UPDATE selectedCareers SET idCareer = ? WHERE ID = ?");
        $stmt->bind_param("ii", $idCareer, $idSelectedCareer);
    
        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos de la carrera seleccionada: ' . $stmt->error);
        }
    
        // Devuelve verdadero si la actualización fue exitosa (aunque no se modificó ninguna fila)
        return $stmt->affected_rows >= 0;
    }
    

    // Borrar
    public function deleteSelectedCareerById($id) {
        $stmt = $this->con->prepare("DELETE FROM selectedCareers WHERE ID = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar la carrera seleccionada: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Listar carreras seleccionadas
    public function getSelectedCareers() {
        $stmt = $this->con->prepare("SELECT * FROM selectedCareers");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener las carreras seleccionadas: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $selectedCareers = [];

        while ($row = $result->fetch_assoc()) {
            $selectedCareers[] = $row;
        }

        return $selectedCareers;
    }

    // Otras

    // Listar Carreras seleccionadas por idInscription
    public function getSelectedCareersByInscriptionID($idInscription) {
        $stmt = $this->con->prepare("select * from selectedCareers WHERE idInscription = ?");
        $stmt->bind_param("i", $idInscription);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar las carreras seleccionadas por idInscription: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        $selectedCareers = array();

        while ($row = $result->fetch_assoc()) {
            $selectedCareers[] = $row;
        }

        return $selectedCareers;
    }
}
