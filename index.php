<?php
session_start();
require_once 'config/database.php';
require_once 'app/routes/web.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$router = new Router();
$router->route($url);
$conn = mysqli_connect("localhost", "root", "", "tabungan_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$page = $_GET['page'] ?? 'home';

if (!isset($_SESSION['user_id']) && $page != 'login' && $page != 'register') {
    header("Location: index.php?page=login");
    exit;
}

include 'header.php';

switch ($page) {
    case 'login':
        include 'login.php';
        break;
    case 'register':
        include 'register.php';
        break;
    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    case 'save':
        include 'save.php';
        break;
    case 'admin':
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
mysqli_close($conn);
?>
