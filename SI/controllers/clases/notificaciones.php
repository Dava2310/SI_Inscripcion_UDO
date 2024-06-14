<?php

/**  
 * Clase Notificaiones
 * 
 * Esta clase representa a una notificacion dentro del sistema.
 * Maneja todas las consultas MySQL respecto a esta entidad.
 */

include_once(__DIR__ . '/../conexion.php');

class Notification
{

    private $con;

    /**
     * Constructor de la clase Notificacion
     * 
     * Crea una nueva instancia de la clase Notification y establece la conexion a la BD
     */
    public function __construct()
    {
        // Incluir la conexion a la BD
        $this->con = Connection::getInstance()->getConnection();
    }

    public function sendNotificationByStudentId($idStudent, $content, $date)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("INSERT INTO notifications (content, idStudent, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $content, $idStudent, $date);

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

    public function getNotificationsById($idStudent)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * from notifications WHERE idStudent = ? OR idStudent = NULL");
        $stmt->bind_param("i", $idStudent);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al obtener las notificaciones');
            exit;
        }

        // Recogiendo los resultados de la query
        $result = $stmt->get_result();

        // Verificando si hay registros
        if ($result->num_rows > 0) {
            $notificaciones = array();

            // Obtener los datos de las notificaciones en un array
            while ($row = $result->fetch_assoc()) {
                $notificaciones[] = $row;
            }

            return $notificaciones;
        } else {
            return false;
        }
    }
}
