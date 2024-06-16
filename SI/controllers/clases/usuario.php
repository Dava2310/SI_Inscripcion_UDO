<?php

include_once (__DIR__ . '/../conexion.php');

class User
{
    private $con;

    public function __construct()
    {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerUser($name, $lastName, $licenseID, $email, $idRole, $password)
    {
        $stmt = $this->con->prepare("INSERT INTO users (name, lastName, licenseID, email, idRole, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $name, $lastName, $licenseID, $email, $idRole, $password);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                throw new Exception('Error: No se pudo crear el usuario.');
            }
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    }

    // Leer
    public function getUserByID($ID)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $ID);

        if (!$stmt->execute()) {
            throw new Exception('Error al buscar el usuario por ID: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Actualizar
    public function updateUser($userID, $name, $lastName, $email, $licenseID)
    {
        $stmt = $this->con->prepare("UPDATE users SET name = ?, lastName = ?, email = ?, licenseID = ? WHERE ID = ?");
        $stmt->bind_param("ssssi", $name, $lastName, $email, $licenseID, $userID);

        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos del usuario: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    // Borrar
    public function deleteUserById($userID)
    {
        $stmt = $this->con->prepare("DELETE FROM users WHERE ID = ?");
        $stmt->bind_param("i", $userID);

        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar el empleado: ' . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }


    // Listar usuarios
    public function getUsers()
    {
        $stmt = $this->con->prepare("SELECT * FROM users");

        if (!$stmt->execute()) {
            throw new Exception('Error al obtener los usuarios: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $usuarios = [];

        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    // OTROS //

    // Obtener datos por Credeneciales
    public function validateUser($email, $password)
    {
        $stmt = $this->con->prepare("SELECT idRole, ID FROM users WHERE email = ? and password = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $password);

        if (!$stmt->execute()) {
            throw new Exception('Error al validar el usuario: ' . $stmt->error);
            exit;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? array(
            'idRole' => $row['idRole'],
            'ID' => $row['ID']
        ) : false;
    }

    // Verificar si el correo pertenece a un estudiante
    public function checkEmail($email)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);

        if (!$stmt->execute()) {
            throw new Exception('Error al verificar el email');
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }

    public function existsEmail($email)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);

        if (!$stmt->execute()) {
            throw new Exception('Error al verificar el email');
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function existsEmailButNotUserId($email, $userId)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE email = ? AND ID != ?');
        $stmt->bind_param('si', $email, $userId);

        if (!$stmt->execute()) {
            throw new Exception('Error al verificar el email');
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true; // Existe otro usuario con ese email y diferente ID
        } else {
            return false; // No existe otro usuario con ese email y diferente ID
        }
    }

    public function checkLicenseID($licenseID)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE licenseID = ?');
        $stmt->bind_param('s', $licenseID);

        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }

    public function existsLicenseID($licenseID)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE licenseID = ?');
        $stmt->bind_param('s', $licenseID);

        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function existsLicenseIDButNotUserId($licenseID, $userId)
    {
        $stmt = $this->con->prepare('SELECT * FROM users WHERE licenseID = ? AND ID != ?');
        $stmt->bind_param('si', $licenseID, $userId);

        if (!$stmt->execute()) {
            throw new Exception('Error al verificar el licenseID');
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true; // Existe otro usuario con ese licenseID y diferente ID
        } else {
            return false; // No existe otro usuario con ese licenseID y diferente ID
        }
    }

    // Cambiar Contraseña
    public function updatePassword($email, $password, $securityAnswer, $securityQuestion, $ID)
    {
        $stmt = $this->con->prepare('UPDATE users SET password = ? WHERE email = ? AND securityAnswer = ? AND securityQuestion = ? AND ID = ?');
        $stmt->bind_param('ssssi', $password, $email, $securityAnswer, $securityQuestion, $ID);

        if (!$stmt->execute()) {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
            return false;
        }
        return true;
    }

    // Crear pregunta Seguridad
    public function createSecurityQuestion($userID, $securityQuestion, $securityAnswer, $newPassword)
    {
        $stmt = $this->con->prepare('UPDATE users SET securityQuestion = ?, securityAnswer = ?, password = ? WHERE ID = ?');
        $stmt->bind_param('sssi', $securityQuestion, $securityAnswer, $newPassword, $userID);

        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar la pregunta de seguridad: ' . $stmt->error);
        }

        return true;
    }


}
