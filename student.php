<?php
class Student {
    private $conn;
    private $table = "students";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all students
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single student by ID
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new student
    public function create($data) {
        $query = "INSERT INTO {$this->table} (name, email, phone, course) VALUES (:name, :email, :phone, :course)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':course' => $data['course']
        ]);
    }

    // Update student by ID
    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET name = :name, email = :email, phone = :phone, course = :course WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':course' => $data['course'],
            ':id' => $id
        ]);
    }

    // Delete student by ID
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Search by name or course
    public function search($search = '') {
        $query = "SELECT * FROM {$this->table} WHERE name LIKE :search OR course LIKE :search ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
