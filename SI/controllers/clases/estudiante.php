<?php

include_once(__DIR__ . '/../conexion.php');

class Student
{
    private $con;

    public function __construct()
    {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUDS // 

    // Registrar (Crear)
    public function registerStudent($licenseID, $name, $lastName, $email, $birthday, $nationality, $phoneNumber, $address, $password, $securityQuestion, $securityAnswer, $state = 'Active')
    {
        $stmt = $this->con->prepare('INSERT INTO students(licenseID, name, lastName, email, birthday, nationality, phoneNumber, address, password, securityQuestion, securityAnswer, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssssssss', $licenseID, $name, $lastName, $email, $birthday, $nationality, $phoneNumber, $address, $password, $securityQuestion, $securityAnswer, $state);

        if (!$stmt->execute()) {
            throw new Exception('Error al crear el estudiante: ' . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Obtener Estudiante por ID (Leer)
    public function getStudentByID($id)
    {
        if (!($this->isActiveByID($id))) {
            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }

        $stmt = $this->con->prepare("SELECT * FROM students WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            echo json_encode('Error al buscar el estudiante por ID');
            exit;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante;
        } else {
            return false;
        }
    }

    // Actualizar Estudiante
    public function updateStudent($id, $licenseID, $name, $lastName, $email, $phoneNumber, $address)
    {
        if (!($this->isActiveByID($id))) {
            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }

        $stmt = $this->con->prepare("UPDATE students SET licenseID = ?, name = ?, lastName = ?, email = ?, phoneNumber = ?, address = ? WHERE ID = ?");
        $stmt->bind_param("ssssssi", $licenseID, $name, $lastName, $email, $phoneNumber, $address, $id);

        if (!$stmt->execute()) {
            echo json_encode('Error al actualizar los datos del estudiante');
            exit;
        }

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Borrar Estudiante
    public function deleteStudentById($studentID)
    {
        $stmt = $this->con->prepare("DELETE FROM students WHERE ID = ?");
        $stmt->bind_param("i", $studentID);

        if (!$stmt->execute()) {
            echo json_encode('Error al eliminar el estudiante');
            exit;
        }

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Listar Estudiantes
    public function getStudents()
    {
        $stmt = $this->con->prepare("SELECT * FROM students");

        if (!$stmt->execute()) {
            echo json_encode('Error al obtener los estudiantes');
            exit;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estudiantes = array();

            while ($row = $result->fetch_assoc()) {
                $estudiantes[] = $row;
            }

            return $estudiantes;
        } else {
            return false;
        }
    }

    // OTROS //

    // Obtener datos por Credeneciales
    public function validateStudent($email, $password)
    {
        $stmt = $this->con->prepare("SELECT ID, name, lastName, email, phoneNumber, address FROM students WHERE email = ? and password = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $password);

        if (!$stmt->execute()) {
            throw new Exception('Error al validar el estudiante: ' . $stmt->error);
            exit;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? array(
            'ID' => $row['ID'],
            'name' => $row['name'],
            'lastName' => $row['lastName'],
            'email' => $row['email'],
            'phoneNumber' => $row['phoneNumber'],
            'address' => $row['address']
        ) : false;
    }

    // Verificar estado por cedula
    public function isActiveByLicense($licenseID)
    {
        $stmt = $this->con->prepare("SELECT state FROM students WHERE licenseID = ? LIMIT 1");
        $stmt->bind_param("s", $licenseID);

        if (!$stmt->execute()) {
            echo json_encode('Error al verificar el estado del estudiante por LicenseID');
            exit;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante['state'] === 'Active';
        } else {
            return false;
        }
    }

    // Verificar Estudiante Activo
    public function isActiveByID($id)
    {
        $stmt = $this->con->prepare("SELECT state FROM students WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            echo json_encode('Error al verificar el estado del estudiante por ID');
            exit;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante['state'] === 'Active';
        } else {
            return false;
        }
    }

    // Obtener estudiantes por cedula
    public function getStudentByLicense($licenseID)
    {
        if (!($this->isActiveByLicense($licenseID))) {
            echo json_encode('Ocurrio un error. El estudiante no esta activo');
            exit;
        }

        $stmt = $this->con->prepare("SELECT * FROM students WHERE licenseID = ? LIMIT 1");
        $stmt->bind_param("s", $licenseID);

        if (!$stmt->execute()) {
            echo json_encode('Error al buscar el estudiante por LicenseID');
            exit;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            return $estudiante;
        } else {
            return false;
        }
    }

    // Comprobar si el email corresponde a un estudiante
    public function checkEmail($email)
    {
        $stmt = $this->con->prepare('SELECT * FROM students WHERE email = ?');
        $stmt->bind_param('s', $email);

        if (!$stmt->execute()) {
            throw new Exception('Error al verificar el email');
            return false;
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            return $student;
        } else {
            return false;
        }
    }

    // Cambiar Contraseña
    public function updatePassword($email, $password, $securityAnswer, $securityQuestion, $ID)
    {
        $stmt = $this->con->prepare('UPDATE students SET password = ? WHERE email = ? AND securityAnswer = ? AND securityQuestion = ? AND ID = ?');
        $stmt->bind_param('ssssi', $password, $email, $securityAnswer, $securityQuestion, $ID);

        if (!$stmt->execute()) {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
            return false;
        }
        return true;
    }
}
