<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e(($title ?? 'Quản trị') . ' | ' . config('app.name')) ?></title>
  <link rel="stylesheet" href="<?= e(base_url('assets/css/tailadmin.css')) ?>">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
  <script src="<?= e(base_url('assets/js/main.js')) ?>" defer></script>
</head>
<body class="admin-page">
  <a class="skip-link" href="#main">Đến nội dung chính</a>
  <div class="relative flex min-h-screen flex-col lg:flex-row">
    <?php require BASE_PATH . '/app/views/admin/layouts/sidebar.php'; ?>
    <div class="relative flex min-w-0 flex-1 flex-col">
      <header class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 bg-white px-5 py-4">
        <a href="<?= e(base_url()) ?>">Về website</a>
        <div class="flex flex-wrap items-center gap-3">
          <a href="<?= e(base_url('profile')) ?>"><?= e(Auth::user()['name']) ?></a>
          <form action="<?= e(base_url('logout')) ?>" method="post">
            <?= Csrf::field() ?>
            <button class="button button-secondary" type="submit">Đăng xuất</button>
          </form>
        </div>
      </header>
      <main class="w-full p-4 md:p-6" id="main">
        <?php require BASE_PATH . '/app/views/partials/messages.php'; ?>
        <?php require $viewFile; ?>
      </main>
    </div>
  </div>
</body>
</html>
