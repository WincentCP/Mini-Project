<?php
class AuthMiddleware {
    public static function isAuthenticated() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit();
        }
    }

    public static function isAdmin() {
        self::isAuthenticated();
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: home');
            exit();
        }
    }

    public static function isGuest() {
        if (isset($_SESSION['user_id'])) {
            header('Location: home');
            exit();
        }
    }
}
