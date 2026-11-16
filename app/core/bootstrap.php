<?php
session_start();

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

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function base_url($path = '') {
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return $base . '/' . ltrim($path, '/');
}

// Mỗi module một file route -> hạn chế conflict khi merge
foreach (glob(BASE_PATH . '/app/routes/*.php') as $routeFile) {
    require $routeFile;
}

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
