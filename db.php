<?php

class Database {
    private $host = "localhost";
    private $user = "root";       
    private $password = "";       
    private $database = "student_db";
    public $conn;

    
    public function getConnection() {
        $this->conn = null;

        try {
            
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            
        
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch(Exception $e) {
            echo "Database Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>