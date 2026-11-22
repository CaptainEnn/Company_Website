<?php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

define('BASE_PATH', dirname(__DIR__));
require BASE_PATH . '/app/core/init.php';

if ($argc !== 3) {
    fwrite(STDERR, "Usage: php scripts/create-admin.php <email> \"<name>\"\n");
    exit(1);
}
$email = strtolower(trim($argv[1]));
$name = trim($argv[2]);
$validator = AccountForm::details($name, $email);
if ($validator->fails()) {
    fwrite(STDERR, implode("\n", $validator->errors()) . "\n");
    exit(1);
}

$password = bin2hex(random_bytes(16));
if (!(new User())->create($name, $email, $password, 'admin')) {
    fwrite(STDERR, "Email đã tồn tại.\n");
    exit(1);
}
echo "Email quản trị: $email\nMật khẩu khởi tạo: $password\nĐăng nhập vào Hồ sơ để đổi mật khẩu.\n";
