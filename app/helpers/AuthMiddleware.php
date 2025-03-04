<?php
class AuthMiddleware {
    // Fungsi untuk memeriksa apakah pengguna sudah login
    public static function isAuthenticated() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit();
        }
    }

    // Fungsi untuk memeriksa apakah pengguna adalah admin
    public static function isAdmin() {
        self::isAuthenticated();
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: home');
            exit();
        }
    }

    // Fungsi untuk memeriksa apakah pengguna adalah guest (belum login)
    public static function isGuest() {
        if (isset($_SESSION['user_id'])) {
            header('Location: home');
            exit();
        }
    }
}
