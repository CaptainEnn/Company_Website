<?php
class Csrf
{
    public static function token()
    {
        if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
        return $_SESSION['csrf'];
    }
    public static function field() { return '<input type="hidden" name="_csrf" value="' . self::token() . '">'; }
    public static function verify()
    {
        $t = isset($_POST['_csrf']) ? $_POST['_csrf'] : '';
        if (!is_string($t) || !hash_equals(self::token(), $t)) { http_response_code(403); exit('CSRF token invalid'); }
    }
}
