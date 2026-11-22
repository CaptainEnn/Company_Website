<section class="panel auth-panel">
  <h1>Đăng ký</h1>
  <form action="<?= e(base_url('register')) ?>" method="post">
    <?= Csrf::field() ?>
    <?php require BASE_PATH . '/app/views/partials/account-fields.php'; ?>
    <?php $passwordLabel = 'Mật khẩu'; require BASE_PATH . '/app/views/partials/new-password.php'; ?>
    <button type="submit">Tạo tài khoản</button>
  </form>
  <p>Đã có tài khoản? <a href="<?= e(base_url('login')) ?>">Đăng nhập</a></p>
</section>
