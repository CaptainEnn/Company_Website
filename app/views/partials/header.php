<?php $visitor = Auth::user(); ?>
<header class="site-header">
  <div class="container nav-row">
    <a class="brand" href="<?= e(base_url()) ?>"><?= e(config('app.name')) ?></a>
    <nav aria-label="Điều hướng chính">
      <a href="<?= e(base_url()) ?>">Trang chủ</a>
      <?php if ($visitor): ?>
        <a href="<?= e(base_url('profile')) ?>">Hồ sơ</a>
        <?php if (Auth::isAdmin()): ?><a href="<?= e(base_url('admin/users')) ?>">Quản trị</a><?php endif; ?>
        <form action="<?= e(base_url('logout')) ?>" method="post">
          <?= Csrf::field() ?>
          <button type="submit" class="button button-secondary">Đăng xuất</button>
        </form>
      <?php else: ?>
        <a href="<?= e(base_url('login')) ?>">Đăng nhập</a>
        <a class="button" href="<?= e(base_url('register')) ?>">Đăng ký</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
