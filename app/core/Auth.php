<?php

class Auth
{
    private static $checked = false;
    private static $user;

    public static function user()
    {
        if (!self::$checked) {
            self::$checked = true;
            if (isset($_SESSION['user']['id'], $_SESSION['user']['version'])) {
                $user = (new User())->find($_SESSION['user']['id']);
                if ($user && $user['status'] === 'active'
                    && (int)$user['session_version'] === $_SESSION['user']['version']) {
                    self::$user = $user;
                } else {
                    self::logout();
                }
            }
        }
        return self::$user;
    }

    public static function check() { return self::user() !== null; }

    public static function isAdmin()
    {
        $user = self::user();
        return $user && $user['role'] === 'admin' && !$user['must_change_password'];
    }

    public static function login($user)
    {
        session_regenerate_id(true);
        unset($_SESSION['csrf'], $_SESSION['login_attempts']);
        $_SESSION['user'] = ['id' => (int)$user['id'], 'version' => (int)$user['session_version']];
        self::$checked = true;
        self::$user = $user;
    }

    public static function logout()
    {
        unset($_SESSION['user'], $_SESSION['csrf']);
        session_regenerate_id(true);
        self::$checked = true;
        self::$user = null;
    }

    public static function requireGuest()
    {
        if (self::check()) self::redirect('profile');
    }

    public static function requireLogin()
    {
        if (!self::check()) self::redirect('login');
    }

    public static function requireMember()
    {
        self::requireLogin();
        if (self::user()['must_change_password']) self::redirect('profile');
    }

    public static function requireAdmin()
    {
        self::requireMember();
        if (!self::isAdmin()) {
            http_response_code(403);
            exit('403 — Bạn không có quyền quản trị.');
        }
    }

    private static function redirect($path)
    {
        header('Location: ' . base_url($path), true, 303);
        exit;
    }
}
