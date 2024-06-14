<?php
include_once(__DIR__ . '/../conexion.php');

class Career {
    private $con;

    public function __construct() {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerCareer($name, $description, $code) {
        $stmt = $this->con->prepare('INSERT INTO careers(name, description, code) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $description, $code);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo crear la carrera.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Leer
    public function getCareerByID($id) {
        $stmt = $this->con->prepare("SELECT * FROM careers WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar la carrera por ID: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Actualizar
    public function updateCareer($id, $name, $description, $code) {
        $stmt = $this->con->prepare("UPDATE careers SET name = ?, description = ?, code = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $name, $description, $code, $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos de la carrera: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Borrar
    public function deleteCareerById($careerID) {
        $stmt = $this->con->prepare("DELETE FROM careers WHERE ID = ?");
        $stmt->bind_param("i", $careerID);

        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar la carrera: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Listar carreras
    public function getCareers() {
        $stmt = $this->con->prepare("SELECT * FROM careers");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener las carreras: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $careers = [];

        while ($row = $result->fetch_assoc()) {
            $careers[] = $row;
        }

        return $careers;
    }
}

?>
