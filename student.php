<?php
class Student {
    private $conn;
    private $table_name = "students";

    public $id;
    public $full_name;
    public $email;
    public $phone;
    public $address;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . " (full_name, email, phone, address) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));

        $stmt->bind_param("ssss", $this->full_name, $this->email, $this->phone, $this->address);

        if($stmt->execute()){
            return $this->conn->insert_id;
        }
        return false;
    }

    public function read($search_keyword = "", $offset = 0, $records_per_page = 5){
        $query = "SELECT id, full_name, email, phone, address FROM " . $this->table_name;
        
        
        if(!empty($search_keyword)) {
            $query .= " WHERE full_name LIKE ? OR email LIKE ?";
        }
        
        $query .= " ORDER BY id DESC LIMIT ?, ?";
        
        $stmt = $this->conn->prepare($query);
        
        if(!empty($search_keyword)) {
            $search = "%{$search_keyword}%";
            $stmt->bind_param("ssii", $search, $search, $offset, $records_per_page);
        } else {
            $stmt->bind_param("ii", $offset, $records_per_page);
        }
        
        $stmt->execute();
        return $stmt->get_result();
    }

   
    public function countAll($search_keyword = ""){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        
        if(!empty($search_keyword)) {
            $query .= " WHERE full_name LIKE ? OR email LIKE ?";
        }
        
        $stmt = $this->conn->prepare($query);
        
        if(!empty($search_keyword)) {
            $search = "%{$search_keyword}%";
            $stmt->bind_param("ss", $search, $search);
        }
        
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row['total_rows'];
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($row = $result->fetch_assoc()) {
            $this->full_name = $row['full_name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->address = $row['address'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET full_name=?, email=?, phone=?, address=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("ssssi", $this->full_name, $this->email, $this->phone, $this->address, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>