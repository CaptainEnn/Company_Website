<p><a href="<?= e(base_url('admin/users')) ?>">← Danh sách người dùng</a></p>
<h1><?= e($account['name']) ?></h1>
<section class="panel">
  <h2>Thông tin tài khoản</h2>
  <?php if ($account['avatar']): ?>
    <img class="avatar" src="<?= e(base_url($account['avatar'])) ?>" alt="Ảnh đại diện" width="96" height="96">
  <?php endif; ?>
  <dl class="account-details">
    <dt>Email</dt><dd><?= e($account['email']) ?></dd>
    <dt>Số điện thoại</dt><dd><?= e($account['phone'] ?: 'Chưa cập nhật') ?></dd>
    <dt>Vai trò</dt><dd><?= $account['role'] === 'admin' ? 'Quản trị viên' : 'Thành viên' ?></dd>
    <dt>Trạng thái</dt><dd><?= $account['status'] === 'active' ? 'Hoạt động' : 'Đã khóa' ?></dd>
    <dt>Ngày tạo</dt><dd><?= e($account['created_at']) ?></dd>
  </dl>
</section>
<?php if ($account['role'] === 'member'): ?>
  <?php $path = 'admin/users/' . $account['id']; ?>
  <div class="profile-grid admin-actions">
    <section class="panel">
      <h2>Sửa thông tin</h2>
      <form action="<?= e(base_url($path . '/edit')) ?>" method="post">
        <?= Csrf::field() ?>
        <?php $showPhone = true; require BASE_PATH . '/app/views/partials/account-fields.php'; ?>
        <button type="submit">Lưu thông tin</button>
      </form>
    </section>
    <section class="panel">
      <h2>Đặt lại mật khẩu</h2>
      <p>Gửi mật khẩu tạm cho thành viên qua kênh riêng. Thành viên phải đổi mật khẩu ở lần đăng nhập tiếp theo.</p>
      <form action="<?= e(base_url($path . '/reset')) ?>" method="post">
        <?= Csrf::field() ?>
        <?php $passwordLabel = 'Mật khẩu tạm'; require BASE_PATH . '/app/views/partials/new-password.php'; ?>
        <button type="submit">Đặt lại mật khẩu</button>
      </form>
    </section>
    <section class="panel">
      <h2>Trạng thái và quyền truy cập</h2>
      <form action="<?= e(base_url($path . '/status')) ?>" method="post">
        <?= Csrf::field() ?>
        <input type="hidden" name="status" value="<?= $account['status'] === 'active' ? 'banned' : 'active' ?>">
        <button class="button button-secondary" type="submit"><?= $account['status'] === 'active' ? 'Khóa tài khoản' : 'Mở khóa tài khoản' ?></button>
      </form>
      <form class="delete-form" action="<?= e(base_url($path . '/delete')) ?>" method="post">
        <?= Csrf::field() ?>
        <label class="check-label"><input type="checkbox" name="confirm_delete" value="1" required> Tôi xác nhận xóa tài khoản này</label>
        <button class="button button-danger" type="submit">Xóa tài khoản</button>
      </form>
    </section>
  </div>
<?php endif; ?>
