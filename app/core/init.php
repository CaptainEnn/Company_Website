<?php

$GLOBALS['config'] = require BASE_PATH . '/app/config/config.php';

// Autoload đơn giản (không dùng Composer/framework)
spl_autoload_register(function ($class) {
    $dirs = ['core', 'models', 'controllers', 'controllers/admin', 'helpers'];
    foreach ($dirs as $d) {
        $f = BASE_PATH . "/app/$d/$class.php";
        if (file_exists($f)) { require $f; return; }
    }
});

function config($key, $default = null) {
    $v = $GLOBALS['config'];
    foreach (explode('.', $key) as $k) {
        if (!is_array($v) || !isset($v[$k])) return $default;
        $v = $v[$k];
    }
    return $v;
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

function base_url($path = '') {
    $base = rtrim(str_replace('\\', '/', dirname(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/index.php')), '/');
    return $base . '/' . ltrim($path, '/');
}

