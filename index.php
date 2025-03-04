<?php
// Start session
session_start();
require_once 'config/database.php';
require_once 'routes/web.php';

// Get URL parameter
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$router = new Router();
$router->route($url);

// Database connection
$conn = mysqli_connect("localhost", "root", "", "tabungan_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Get current page
$page = $_GET['page'] ?? 'home';

// Check login status
if (!isset($_SESSION['user_id']) && $page != 'login' && $page != 'register') {
    header("Location: index.php?page=login");
    exit;
}

include 'header.php';

// Page routing
switch ($page) {
    case 'login':
        include 'login.php';
        break;
    case 'register':
        include 'register.php';
        break;
    case 'logout':
        session_destroy();      // Clear session
        header("Location: index.php?page=login");
        exit;
    case 'save':
        include 'save.php';
        break;
    case 'admin':
        // Check admin access
        if ($_SESSION['user_role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }
        include 'admin.php';
        break;
    default:
        include 'home.php';
        break;
}

include 'footer.php';

// Close database connection
mysqli_close($conn);
?>