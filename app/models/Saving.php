<?php
class Saving {
    private $conn;
    private $table = 'savings';

    // Konstruktor: inisialisasi koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk membuat data tabungan baru
    public function create($user_id, $amount, $message) {
        $query = "INSERT INTO " . $this->table . " (user_id, amount, message) VALUES (:user_id, :amount, :message)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':message', $message);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fungsi untuk mengambil semua data tabungan
    public function getAll() {
        $query = "SELECT s.*, u.name FROM " . $this->table . " s
                  JOIN users u ON s.user_id = u.id
                  ORDER BY s.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil data tabungan berdasarkan ID pengguna
    public function getByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk menghitung total tabungan berdasarkan ID pengguna
    public function getTotalByUserId($user_id) {
        $query = "SELECT SUM(amount) as total FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ? $result['total'] : 0;
    }

    // Fungsi untuk menghitung total seluruh tabungan
    public function getTotal() {
        $query = "SELECT SUM(amount) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ? $result['total'] : 0;
    }
}
