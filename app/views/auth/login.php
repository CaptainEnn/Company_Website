<section class="panel auth-panel">
  <h1>Đăng nhập</h1>
  <form action="<?= e(base_url('login')) ?>" method="post">
    <?= Csrf::field() ?>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="<?= e($values['email']) ?>" maxlength="150" required autocomplete="username">
    <label for="login-password">Mật khẩu</label>
    <input id="login-password" name="password" type="password" maxlength="72" required autocomplete="current-password">
    <button type="submit">Đăng nhập</button>
  </form>
  <p>Chưa có tài khoản? <a href="<?= e(base_url('register')) ?>">Đăng ký</a></p>
</section>
