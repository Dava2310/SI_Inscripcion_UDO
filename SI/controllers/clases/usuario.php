<?php

    /**
     * Clase Usuario
     * 
     * Esta clase representa a un usuario en el sistema.
     */
    include_once(__DIR__ . '/../conexion.php');

    class Usuario {

        private $con;
        
        /**
         * Constructor de la clase Usuario
         * 
         * Crea una nueva instancia de la clase Usuario y establece la conexión a la base de datos.
         */
        public function __construct() {
            // Incluir la conexion a base de datos
            $this->con = Connection::getInstance()->getConnection();
        }
        
        /**
         * Crear Usuario
         *
         * Crea un nuevo usuario en la base de datos con los datos proporcionados.
         *
         * @param string $name El nombre del usuario.
         * @param string $lastName El apellido del usuario.
         * @param string $licenseID El ID de la licencia del usuario.
         * @param string $email El correo electrónico del usuario.
         * @param int $idRole El ID del rol del usuario.
         * @param string $password La contraseña del usuario.
         * 
         * @return bool Retorna true si el usuario se creó correctamente en la base de datos, de lo contrario retorna false.
         */
        public function registerEmployees($name, $lastName, $licenseID, $email, $idRole, $password) 
        { 
            // Preparación de la consulta SQL
            $stmt = $this->con->prepare("INSERT INTO employees (name, lastName, licenseID, email, idRole, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssis", $name, $lastName, $licenseID, $email, $idRole, $password);

            // Ejecución y verificación de error de ejecución
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al crear el usuario');
                exit;
            }

            // Verificación de filas afectadas para determinar si el usuario se creó correctamente
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Actualizar Datos de Usuario
         *
         * Actualiza el nombre, apellido, edad y teléfono de un usuario en la base de datos.
         *
         * @param int $idUsuario El ID del usuario a actualizar.
         * @param string $nombre El nuevo nombre del usuario.
         * @param string $apellido El nuevo apellido del usuario.
         * @param int $edad La nueva edad del usuario.
         * @param string $telefono El nuevo teléfono del usuario.
         * @return bool Retorna true si los datos del usuario se actualizaron correctamente, de lo contrario retorna false.
         */
        public function updateEmployees($ID, $name, $lastName, $email, $licenseID, $idRole)
        {
            // Preparación de la consulta SQL
            $stmt = $this->con->prepare("UPDATE employees SET name = ?, lastName = ?, email = ?, licenseID = ? WHERE ID = ?");
            $stmt->bind_param("ssssi", $name, $lastName, $email, $licenseID, $ID);

            // Ejecución y verificación de error de ejecución
            if (!$stmt->execute()) {
                echo json_encode('Error al actualizar los datos del usuario');
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
         * Obtener Usuarios
         *
         * Obtiene los datos de todos los usuarios registrados en la base de datos.
         *
         * @return array|bool Retorna un array con los datos de los usuarios si hay registros, de lo contrario retorna false.
         */
        public function getEmployees()
        {
            // Preparación de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM employees");
            
            // Ejecución y verificación de error de ejecución
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al obtener los usuarios');
                exit;
            }

            // Recogiendo los resultados de la query
            $result = $stmt->get_result();
            
            // Verificando si hay registros
            if ($result->num_rows > 0) {
                $usuarios = array();
                
                // Obtener los datos de los usuarios en un array
                while ($row = $result->fetch_assoc()) {
                    $usuarios[] = $row;
                }
                
                return $usuarios;
            } else {
                return false;
            }
        }

        /**
         * Buscar Usuario por ID
         *
         * Busca un usuario en la base de datos según su ID de usuario.
         *
         * @param int $idUsuario El ID del usuario a buscar.
         * @return array|bool Retorna un array con los datos del usuario si se encuentra, de lo contrario retorna false.
         */
        public function getEmployeeByID($ID)
        {
            // Preparación de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM employees WHERE ID = ? LIMIT 1");
            $stmt->bind_param("i", $ID);

            // Ejecución y verificación de error de ejecución
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al buscar el usuario por ID');
                exit;
            }

            // Recogiendo el resultado de la consulta
            $result = $stmt->get_result();
            
            // Verificando si se encontró el usuario
            if ($result->num_rows > 0) {
                $usuario = $result->fetch_assoc();
                return $usuario;
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
        public function validateEmployee($licenseID, $password) {
            // Preparación de la consulta SQL
            $stmt = $this->con->prepare("SELECT idRole, ID FROM employees WHERE licenseID = ? and password = ? LIMIT 1");
            $stmt->bind_param("is", $licenseID, $password);
        
            // Ejecución y verificación de error de ejecución
            if (!$stmt->execute()) {
                echo json_encode('Error al validar usuario');
                exit;
            }
        
            // Recogiendo los resultados de la consulta
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            // Se devuelve el array con el valor de idRol y idUsuario si existe una fila con los resultados de la consulta
            return $row ? array('idRole' => $row['idRole'], 'ID' => $row['ID']) : false;
        }

        /*
        =========================================================================================
        =========================================================================================
        =========================================================================================
        =========================================================================================

                    FUNCIONES EXTRAS A LOS REQUISITOS DE LA CLASE O MODULO DE USUARIO
        
        =========================================================================================
        =========================================================================================
        =========================================================================================
        =========================================================================================

        */

        /**
         * Verificar Email
         *
         * Verifica si existe un usuario con el email especificado en la base de datos.
         *
         * @param string $email El correo electrónico a verificar.
         * @return bool Retorna true si el email existe en la base de datos, de lo contrario retorna false.
         */
        public function verifyEmail($email)
        {
            // Preparacion de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM usuario WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);

            // Ejecucion y verificacion de error de ejecucion
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al verificar el email de usuario');
                exit;
            }

            // Recogiendo los resultados de la consulta
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Se devuelve el valor segun si existe o no una fila con los resultados de la query
            return $row ? true : false;
        }

        /**
         * Verificar Email
         *
         * Verifica si existe un usuario con el email especificado en la base de datos.
         *
         * @param string $email El correo electrónico a verificar.
         * @return bool Retorna true si el email existe en la base de datos, de lo contrario retorna false.
         */
        public function verificarEmailModificacion($email, $idUsuario)
        {
            // Preparacion de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM usuario WHERE email = ? AND idUsuario != ? LIMIT 1");
            $stmt->bind_param("si", $email, $idUsuario);

            // Ejecucion y verificacion de error de ejecucion
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al verificar el email de usuario');
                exit;
            }

            // Recogiendo los resultados de la consulta
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Se devuelve el valor segun si existe o no una fila con los resultados de la query
            return $row ? true : false;
        }

        /**
         * Verificar Email
         *
         * Verifica si existe un usuario con la cedula especificada en la base de datos.
         *
         * @param string $cedula La cedula del usuario a verificar.
         * @return bool Retorna true si la cedula existe en la base de datos, de lo contrario retorna false.
         */
        public function verificarCedula($cedula)
        {
            // Preparacion de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM usuario WHERE cedula = ? LIMIT 1");
            $stmt->bind_param("s", $cedula);

            // Ejecucion y verificacion de error de ejecucion
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al verificar la cedula de usuario');
                exit;
            }

            // Recogiendo los resultados de la consulta
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Se devuelve el valor segun si existe o no una fila con los resultados de la query
            return $row ? true : false;
        }

        /**
         * Verificar Email
         *
         * Verifica si existe un usuario con la cedula especificada en la base de datos.
         *
         * @param string $cedula La cedula del usuario a verificar.
         * @return bool Retorna true si la cedula existe en la base de datos, de lo contrario retorna false.
         */
        public function verificarCedulaModificacion($cedula, $idUsuario)
        {

            // Preparacion de la consulta SQL
            $stmt = $this->con->prepare("SELECT * FROM usuario WHERE cedula = ? AND idUsuario != ? LIMIT 1");
            $stmt->bind_param("si", $cedula, $idUsuario);

            // Ejecucion y verificacion de error de ejecucion
            if (!$stmt->execute()) 
            {
                echo json_encode('Error al verificar la cedula de usuario');
                exit;
            }

            // Recogiendo los resultados de la consulta
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Se devuelve el valor segun si existe o no una fila con los resultados de la query
            return $row ? true : false;
        }

        
        
    }

?>