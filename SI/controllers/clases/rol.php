<?php

include_once(__DIR__ . '/../conexion.php');

class Role {

    private $con;

    public function __construct()
    {
        $this->con = Connection::getInstance()->getConnection();
    }

    // CRUD //

    // Crear
    public function registerRole($name, $description) {
        $stmt = $this->con->prepare('INSERT INTO roles(name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $description);
    
        if (!$stmt->execute()) {
            throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
        }
    
        return $stmt->affected_rows > 0;
    }
    

    // Leer
    public function getRoleByID($id) {
        $stmt = $this->con->prepare("SELECT * FROM roles WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $id);
    
        if (!$stmt->execute()) {
            throw new Exception('Error al buscar el rol por ID: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    

    // Actualizar
    public function updateRole($id, $name, $description) {
        $stmt = $this->con->prepare("UPDATE roles SET name = ?, description = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
    
        if (!$stmt->execute()) {
            throw new Exception('Error al actualizar los datos del rol: ' . $stmt->error);
        }
    
        return $stmt->affected_rows > 0;
    }
    

    // Borrar
    public function deleteRoleById($roleID) {
        $stmt = $this->con->prepare("DELETE FROM roles WHERE ID = ?");
        $stmt->bind_param("i", $roleID);
    
        if (!$stmt->execute()) {
            throw new Exception('Error al eliminar el rol: ' . $stmt->error);
        }
    
        return $stmt->affected_rows > 0;
    }
    

    // Listar roles
    public function getRoles() {
        $stmt = $this->con->prepare("SELECT * FROM roles");
    
        if (!$stmt->execute()) {
            throw new Exception('Error al obtener los roles: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $roles = [];
    
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }
    
        return $roles;
    }
    
}

