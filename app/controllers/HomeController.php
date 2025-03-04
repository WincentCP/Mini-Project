<?php
class HomeController {
    private $db;
    private $savingModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        require_once 'app/models/Saving.php';
        $this->savingModel = new Saving($this->db);
    }

    public function index() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAuthenticated();
        
        $savings = $this->savingModel->getAll();
        $userSavings = $this->savingModel->getByUserId($_SESSION['user_id']);
        $totalSavings = $this->savingModel->getTotalByUserId($_SESSION['user_id']);
        $isAdmin = $_SESSION['user_role'] === 'admin';
        require_once 'app/views/home.php';
    }

    public function admin() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAdmin();
        
        require_once 'app/models/User.php';
        $userModel = new User($this->db);
        $users = $userModel->getAllUsers();
        $savings = $this->savingModel->getAll();
        $totalSavings = $this->savingModel->getTotal();
        require_once 'app/views/admin.php';
    }
}
