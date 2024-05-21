<?php

    /*
        Esta clase esta pensada para hacer uso del metodo: Singleton Pattern
        De modo que a travez de todo el sistema, solo exista una instancia 
        y a su vez una sola conexion a la BD
    */

    class Connection {
        private static $instance = null;
        private $con;
    
        private function __construct() {
            $this->con = new mysqli("localhost:3306", "root", "", "studentDB");
        
            // Verificar errores en la conexión
            if ($this->con->connect_errno) {
                echo "Error al conectar a la base de datos: " . $this->con->connect_error;
                exit;
            }
        }
    
        public static function getInstance() {
            if(!self::$instance) {
                self::$instance = new Connection();
            }
    
            return self::$instance;
        }
    
        public function getConnection() {
            return $this->con;
        }
    }
