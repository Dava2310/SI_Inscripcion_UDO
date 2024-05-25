<?php

/**  
 * Clase Estudiante
 * 
 * Esta clase representa a un estudiante dentro del sistema.
 * Maneja todas las consultas MySQL respecto a esta entidad.
 */

include_once(__DIR__ . '/../conexion.php');

class Student
{

    private $con;

    /**
     * Constructor de la clase Student
     * 
     * Crea una nueva instancia de la clase Student y establece la conexion a la BD
     */
    public function __construct()
    {

        // Incluir la conexion a la BD
        $this->con = Connection::getInstance()->getConnection();
    }

    /**
     * Crear Estudiante
     * 
     * Crea un nuevo estudiante en la Base de Datos con los datos proporcionados.
     *
     * @param string $licenseID   El ID de la licencia del estudiante.
     * @param string $name        El nombre del estudiante.
     * @param string $lastName    El apellido del estudiante.
     * @param string $email       El correo electrónico del estudiante.
     * @param string $password    La contraseña del estudiante.
     * @param string $phoneNumber El número de teléfono del estudiante.
     * @param string $address     La dirección del estudiante.
     *
     * @return bool Devuelve true si el estudiante se creó correctamente, false en caso contrario.
     */
    public function registerStudent($licenseID, $name, $lastName, $email, $password, $phoneNumber, $address)
    {
        // Preparacion de la consulta SQL
        $stmt = $this->con->prepare('INSERT INTO students(licenseID, name, lastName, email, password, phoneNumber, address) VALUES (?,?,?,?,?,?,?)');
        $stmt->bind_param('sssssss', $licenseID, $name, $lastName, $email, $password, $phoneNumber, $address);

        // Ejecucion y verificacion de error de ejecucion
        if (!$stmt->execute()) {
            echo json_encode('Error al crear el estudiante');
            exit;
        }

        // Verificacion de las filas afectadas para determinar si el usuario se creo de forma correcta
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validar Usuario
     * 
     * Valida las credenciales de un usuario en la base de datos.
     * 
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return int|bool Retorna el número de idRol si las credenciales son válidas, de lo contrario retorna false.
     */

    public function validateStudent($email, $password)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT ID, name, lastName, email, phoneNumber, address FROM students WHERE email = ? and password = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $password);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al validar estudiante');
            exit;
        }

        // Recogiendo los resultados de la consulta
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Se devuelve el array con el valor de idRol y idUsuario si existe una fila con los resultados de la consulta
        return $row ? array(
            'ID' => $row['ID'],
            'name' => $row['name'],
            'lastName' => $row['lastName'],
            'email' => $row['email'],
            'phoneNumber' => $row['phoneNumber'],
            'address' => $row['address']
        ) : false;
    }

    /**
     * Verificar si un estudiante está activo por LicenseID
     *
     * Verifica si un estudiante en la base de datos está activo según su LicenseID.
     *
     * @param string $licenseID El LicenseID del estudiante a verificar.
     * @return bool Retorna true si el estudiante está activo, de lo contrario retorna false.
     */
    public function isActiveByLicense($licenseID)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT state FROM students WHERE licenseID = ? LIMIT 1");
        $stmt->bind_param("s", $licenseID);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al verificar el estado del estudiante por LicenseID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró el estudiante
        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante['state'] === 'Active';
        } else {
            return false;
        }
    }

    /**
     * Verificar si un estudiante está activo por ID
     *
     * Verifica si un estudiante en la base de datos está activo según su ID.
     *
     * @param int $id El ID del estudiante a verificar.
     * @return bool Retorna true si el estudiante está activo, de lo contrario retorna false.
     */
    public function isActiveByID($id)
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT state FROM students WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al verificar el estado del estudiante por ID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró el estudiante
        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante['state'] === 'Active';
        } else {
            return false;
        }
    }


    /**
     * Modificar Estudiante
     *
     * Modifica los datos de un estudiante en la base de datos.
     *
     * @param int $id El ID del estudiante a actualizar.
     * @param string $licenseID El nuevo ID de la licencia del estudiante.
     * @param string $name El nuevo nombre del estudiante.
     * @param string $lastName El nuevo apellido del estudiante.
     * @param string $email El nuevo correo electrónico del estudiante.
     * @param string $phoneNumber El nuevo número de teléfono del estudiante.
     * @param string $address La nueva dirección del estudiante.
     * @return bool Retorna true si los datos del estudiante se actualizaron correctamente, de lo contrario retorna false.
     */
    public function updateStudent($id, $licenseID, $name, $lastName, $email, $phoneNumber, $address)
    {

        if (!($this->isActiveByID($id))) {

            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }


        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("UPDATE students SET licenseID = ?, name = ?, lastName = ?, email = ?, phoneNumber = ?, address = ? WHERE ID = ?");
        $stmt->bind_param("ssssssi", $licenseID, $name, $lastName, $email, $phoneNumber, $address, $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al actualizar los datos del estudiante');
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
     * Obtener Estudiantes
     *
     * Obtiene los datos de todos los estudiantes registrados en la base de datos.
     *
     * @return array|bool Retorna un array con los datos de los estudiantes si hay registros, de lo contrario retorna false.
     */
    public function getStudents()
    {
        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM students");

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al obtener los estudiantes');
            exit;
        }

        // Recogiendo los resultados de la query
        $result = $stmt->get_result();

        // Verificando si hay registros
        if ($result->num_rows > 0) {
            $estudiantes = array();

            // Obtener los datos de los estudiantes en un array
            while ($row = $result->fetch_assoc()) {
                $estudiantes[] = $row;
            }

            return $estudiantes;
        } else {
            return false;
        }
    }

    /**
     * Buscar Estudiante por ID
     *
     * Busca un estudiante en la base de datos según su ID.
     *
     * @param int $id El ID del estudiante a buscar.
     * @return array|bool Retorna un array con los datos del estudiante si se encuentra, de lo contrario retorna false.
     */
    public function getStudentByID($id)
    {

        if (!($this->isActiveByID($id))) {

            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }

        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM students WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al buscar el estudiante por ID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró el estudiante
        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante;
        } else {
            return false;
        }
    }

    /**
     * Buscar Estudiante por LicenseID
     *
     * Busca un estudiante en la base de datos según su LicenseID.
     *
     * @param string $licenseID El LicenseID del estudiante a buscar.
     * @return array|bool Retorna un array con los datos del estudiante si se encuentra, de lo contrario retorna false.
     */
    public function getStudentByLicense($licenseID)
    {

        if (!($this->isActiveByLicense($licenseID))) {

            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }

        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("SELECT * FROM students WHERE licenseID = ? LIMIT 1");
        $stmt->bind_param("s", $licenseID);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al buscar el estudiante por LicenseID');
            exit;
        }

        // Recogiendo el resultado de la consulta
        $result = $stmt->get_result();

        // Verificando si se encontró el estudiante
        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante;
        } else {
            return false;
        }
    }

    /**
     * Eliminar Estudiante
     *
     * Elimina completamente el registro del estudiante de la base de datos.
     *
     * @param int $id El ID del estudiante a eliminar.
     * @return bool Retorna true si el estudiante fue eliminado con éxito, de lo contrario retorna false.
     */
    public function deleteStudentById($id)
    {
        // Verificar si el estudiante está activo
        if (!($this->isActiveByID($id))) {
            echo json_encode('Ocurrió un error. El estudiante no está activo');
            exit;
        }

        // Preparación de la consulta SQL
        $stmt = $this->con->prepare("DELETE FROM students WHERE ID = ?");
        $stmt->bind_param("i", $id);

        // Ejecución y verificación de error de ejecución
        if (!$stmt->execute()) {
            echo json_encode('Error al eliminar el estudiante');
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
