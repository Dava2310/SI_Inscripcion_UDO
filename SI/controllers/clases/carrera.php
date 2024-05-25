<?php

/**  
 * Clase Career
 * 
 * Esta clase representa una carrera dentro del sistema.
 * Maneja todas las consultas MySQL respecto a esta entidad.
 */

include_once(__DIR__ . '/../conexion.php');

class Career {

    private $con;

    /**
     * Constructor de la clase Career
     * 
     * Crea una nueva instancia de la clase Career y establece la conexion a la BD
     */
    public function __construct() {
        // Incluir la conexion a la BD
        $this->con = Connection::getInstance()->getConnection();
    }

    /**
     * Crear Carrera
     * 
     * Crea una nueva carrera en la Base de Datos con los datos proporcionados.
     *
     * @param string $name El nombre de la carrera.
     * @param string $description La descripción de la carrera.
     *
     * @return bool Devuelve true si la carrera se creó correctamente, false en caso contrario.
     */
    public function registerCareer($name, $description) {
        // Preparacion de la consulta SQL
        $stmt = $this->con->prepare('INSERT INTO careers(name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $description);

        // Ejecucion y verificacion de error de ejecucion
        if (!$stmt->execute()) {
            echo json_encode('Error al crear la carrera');
            exit;
        }

        // Verificacion de las filas afectadas para determinar si la carrera se creo de forma correcta
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Modificar Carrera
     *
     * Modifica los datos de una carrera en la base de datos.
     *
     * @param int $id El ID de la carrera a actualizar.
     * @param string $name El nuevo nombre de la carrera.
     * @param string $description La nueva descripción de la carrera.
     * @return bool Retorna true si los datos de la carrera se actualizaron correctamente, de lo contrario retorna false.
     */
    public function updateCareer($id, $name, $description) {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("UPDATE careers SET name = ?, description = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $name, $description, $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al actualizar los datos de la carrera');
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
     * Obtener Carreras
     *
     * Obtiene los datos de todas las carreras registradas en la base de datos.
     *
     * @return array|bool Retorna un array con los datos de las carreras si hay registros, de lo contrario retorna false.
     */
    public function getCareers() {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM careers");

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al obtener las carreras');
            exit;
        }

        // Recogiendo los resultados de la query
        $result = $stmt->get_result();

        // Verificando si hay registros
        if ($result->num_rows > 0) {
            $carreras = array();

            // Obtener los datos de las carreras en un array
            while ($row = $result->fetch_assoc()) {
                $carreras[] = $row;
            }

            return $carreras;
        } else {
            return false;
        }
    }

    /**
     * Buscar Carrera por ID
     *
     * Busca una carrera en la base de datos según su ID.
     *
     * @param int $id El ID de la carrera a buscar.
     * @return array|bool Retorna un array con los datos de la carrera si se encuentra, de lo contrario retorna false.
     */
    public function getCareerByID($id) {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM careers WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al buscar la carrera por ID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró la carrera
        if ($result->num_rows > 0) {
            $carrera = $result->fetch_assoc();
            return $carrera;
        } else {
            return false;
        }
    }

    /**
     * Eliminar Usuario
     *
     * Elimina completamente el registro del usuario de la base de datos.
     *
     * @param int $id El ID del usuario a eliminar.
     * @return bool Retorna true si el usuario fue eliminado con éxito, de lo contrario retorna false.
     */
    public function deleteCareerById($careerID)
    {

        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("DELETE FROM careers WHERE ID = ?");
        $stmt->bind_param("i", $careerID);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al eliminar la carrera');
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

