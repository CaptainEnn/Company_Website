<?php
// Phân quyền: guest / member / admin
class Auth
{
    public static function user()    { return isset($_SESSION['user']) ? $_SESSION['user'] : null; }
    public static function check()   { return self::user() !== null; }
    public static function isAdmin() { return self::check() && $_SESSION['user']['role'] === 'admin'; }

    public static function requireLogin()
    {
        if (!self::check()) { header('Location: ' . base_url('login')); exit; }
    }
    public static function requireAdmin()
    {
        if (!self::isAdmin()) { http_response_code(403); exit('403 Forbidden'); }
    }
}
