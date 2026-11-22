<?php
require BASE_PATH . '/app/core/init.php';

ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
$secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
$cookiePath = base_url();
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params([
        'path' => $cookiePath, 'secure' => $secure, 'httponly' => true, 'samesite' => 'Lax',
    ]);
} else {
    session_set_cookie_params(0, $cookiePath, '', $secure, true);
}
session_start();
header('X-Content-Type-Options: nosniff');

// Mỗi module một file route -> hạn chế conflict khi merge
foreach (glob(BASE_PATH . '/app/routes/*.php') as $routeFile) {
    require $routeFile;
}

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
