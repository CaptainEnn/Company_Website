<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(isset($title) ? $title . ' | ' . config('app.name') : config('app.name')) ?></title>
  <meta name="description" content="<?= e($metaDesc ?? 'Website thông tin doanh nghiệp và cổng tài khoản thành viên.') ?>">
  <?php if (!empty($noIndex)): ?><meta name="robots" content="noindex, nofollow"><?php endif; ?>
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
  <script src="<?= e(base_url('assets/js/main.js')) ?>" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Đến nội dung chính</a>
  <?php require BASE_PATH . '/app/views/partials/header.php'; ?>
  <main class="container content" id="main">
    <?php require BASE_PATH . '/app/views/partials/messages.php'; ?>
    <?php require $viewFile; ?>
  </main>
  <?php require BASE_PATH . '/app/views/partials/footer.php'; ?>
</body>
</html>
