<?php
include_once(__DIR__ . '/../conexion.php');

class Period {
    private $con;

    public function __construct() {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerPeriod($name, $dateStart, $dateEnd) {
        $stmt = $this->con->prepare('INSERT INTO periods(name, dateStart, dateEnd, validity) VALUES (?, ?, ?, 0)');
        $stmt->bind_param('sss', $name, $dateStart, $dateEnd);
    
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo crear el periodo.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }
    

    // Leer
    public function getPeriodByID($id) {
        $stmt = $this->con->prepare("SELECT * FROM periods WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar el periodo por ID: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Leer ultimo
    public function getCurrentPeriod() {
        $stmt = $this->con->prepare("SELECT * FROM periods WHERE validity = 1 LIMIT 1");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener el periodo actual: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Actualizar
    public function updatePeriod($id, $name, $dateStart, $dateEnd) {
        $stmt = $this->con->prepare("UPDATE periods SET name = ?, dateStart = ?, dateEnd = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $name, $dateStart, $dateEnd, $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos del periodo: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Borrar
    public function deletePeriodById($periodID) {
        $stmt = $this->con->prepare("DELETE FROM periods WHERE ID = ?");
        $stmt->bind_param("i", $periodID);

        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar el periodo: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Listar periodos
    public function getPeriods() {
        $stmt = $this->con->prepare("SELECT * FROM periods");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener los periodos: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $periods = [];

        while ($row = $result->fetch_assoc()) {
            $periods[] = $row;
        }

        return $periods;
    }

    // Otros //

    // Activar periodo
    public function activatePeriod($id) {
        $stmt = $this->con->prepare("UPDATE periods SET validity = 1 WHERE ID = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al activar el periodo: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Terminar periodo
    public function finishPeriod($id) {
        $stmt = $this->con->prepare("UPDATE periods SET validity = 2 WHERE ID = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception('Error al terminar el periodo: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }
}

?>
