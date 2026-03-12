<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $this->name, $this->email, $hashed_password);

        if($stmt->execute()){ return true; }
        return false;
    }

    public function login(){
        $query = "SELECT id, name, password, role FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){
            if(password_verify($this->password, $row['password'])){
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->role = $row['role'];
                return true;
            }
        }
        return false;
    }
    
    public function emailExists(){
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    
    public function readOne(){
        $query = "SELECT name, email, role FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()){
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->role = $row['role'];
            return true;
        }
        return false;
    }

  
    public function update(){
        
        if(!empty($this->password)){
            $query = "UPDATE " . $this->table_name . " SET name=?, email=?, password=? WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $this->name, $this->email, $hashed_password, $this->id);
        } else {
            
            $query = "UPDATE " . $this->table_name . " SET name=?, email=? WHERE id=?";
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $stmt->bind_param("ssi", $this->name, $this->email, $this->id);
        }

        if($stmt->execute()){ return true; }
        return false;
    }
}
?>