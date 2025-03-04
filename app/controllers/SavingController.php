<?php
class SavingController {
    private $db;
    private $savingModel;

    // Konstruktor: inisialisasi database dan model Saving
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        require_once 'app/models/Saving.php';
        $this->savingModel = new Saving($this->db);
    }

    // Fungsi untuk menampilkan halaman simpan tabungan dan memproses penyimpanan
    public function index() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAuthenticated();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];
            $message = $_POST['message'];
            $user_id = $_SESSION['user_id'];

            if($this->savingModel->create($user_id, $amount, $message)) {
                header('Location: home');
                exit();
            }
        }

        require_once 'app/views/save.php';
    }
}
