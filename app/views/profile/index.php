<h1>Hồ sơ cá nhân</h1>
<?php if ($account['must_change_password']): ?>
  <p class="notice notice-error">Mật khẩu hiện tại là mật khẩu tạm. Hãy đổi mật khẩu để sử dụng tài khoản.</p>
<?php endif; ?>
<div class="profile-grid">
  <?php if (!$account['must_change_password']): ?>
    <section class="panel">
      <h2>Thông tin cá nhân</h2>
      <form action="<?= e(base_url('profile/details')) ?>" method="post">
        <?= Csrf::field() ?>
        <?php $showPhone = true; require BASE_PATH . '/app/views/partials/account-fields.php'; ?>
        <label for="email-password">Mật khẩu hiện tại khi đổi email</label>
        <input id="email-password" name="email_password" type="password" autocomplete="current-password"
          data-email-password data-original-email="<?= e($account['email']) ?>">
        <button type="submit">Lưu thông tin</button>
      </form>
    </section>
    <section class="panel">
      <h2>Ảnh đại diện</h2>
      <?php if ($account['avatar']): ?>
        <img class="avatar" src="<?= e(base_url($account['avatar'])) ?>" alt="Ảnh đại diện của <?= e($account['name']) ?>" width="96" height="96">
      <?php else: ?>
        <p>Chưa có ảnh đại diện.</p>
      <?php endif; ?>
      <form action="<?= e(base_url('profile/avatar')) ?>" method="post" enctype="multipart/form-data">
        <?= Csrf::field() ?>
        <label for="avatar">Chọn ảnh mới</label>
        <input id="avatar" name="avatar" type="file" required accept="image/jpeg,image/png,image/webp"
          data-image-limit="<?= e(config('upload.max_size')) ?>" aria-describedby="avatar-hint">
        <small id="avatar-hint">JPEG, PNG hoặc WebP. Tối đa <?= e(config('upload.max_size') / 1048576) ?> MB.</small>
        <button type="submit">Tải ảnh lên</button>
      </form>
    </section>
  <?php endif; ?>
  <section class="panel">
    <h2>Đổi mật khẩu</h2>
    <form action="<?= e(base_url('profile/password')) ?>" method="post">
      <?= Csrf::field() ?>
      <label for="current-password">Mật khẩu hiện tại</label>
      <input id="current-password" name="current_password" type="password" required autocomplete="current-password">
      <?php require BASE_PATH . '/app/views/partials/new-password.php'; ?>
      <button type="submit">Đổi mật khẩu</button>
    </form>
  </section>
</div>
