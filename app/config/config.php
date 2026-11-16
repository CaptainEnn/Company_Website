<?php
// Cấu hình mặc định. Ghi đè cục bộ bằng app/config/config.local.php (đã gitignore)
$config = [
    'db' => ['host' => '127.0.0.1', 'name' => 'company_web', 'user' => 'root', 'pass' => ''],
    'app' => ['name' => 'Company Website', 'debug' => true],
    'upload' => ['max_size' => 2 * 1024 * 1024],
    'per_page' => 10,
];
$local = __DIR__ . '/config.local.php';
if (file_exists($local)) {
    $config = array_replace_recursive($config, require $local);
}
return $config;
