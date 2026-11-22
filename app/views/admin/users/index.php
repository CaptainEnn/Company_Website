<h1>Quản lý người dùng</h1>
<section class="overflow-hidden rounded-xl border border-gray-200 bg-white">
  <div class="p-4 md:p-6">
    <form method="get" action="<?= e(base_url('admin/users')) ?>" class="search-form">
      <label for="user-search">Tìm theo họ tên hoặc email</label>
      <input id="user-search" name="q" maxlength="150" type="search" value="<?= e($search) ?>">
      <button type="submit">Tìm kiếm</button>
    </form>
    <p><?= e($pagination->total) ?> tài khoản</p>
  </div>
  <div class="relative overflow-x-auto" tabindex="0" role="region" aria-label="Danh sách người dùng">
    <table class="account-table">
      <thead><tr><th scope="col">Họ tên</th><th scope="col">Email</th><th scope="col">Vai trò</th><th scope="col">Trạng thái</th><th scope="col">Thao tác</th></tr></thead>
      <tbody>
        <?php foreach ($accounts as $record): ?>
          <tr>
            <td><?= e($record['name']) ?></td>
            <td><?= e($record['email']) ?></td>
            <td><?= $record['role'] === 'admin' ? 'Quản trị viên' : 'Thành viên' ?></td>
            <td><span class="<?= $record['status'] === 'active' ? 'status-active' : 'status-banned' ?>"><?= $record['status'] === 'active' ? 'Hoạt động' : 'Đã khóa' ?></span></td>
            <td><a href="<?= e(base_url('admin/users/' . $record['id'])) ?>">Chi tiết<span class="visually-hidden"> của <?= e($record['name']) ?></span></a></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$accounts): ?><tr><td colspan="5">Không tìm thấy tài khoản.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
  <div class="p-4">
    <?php $paginationPath = 'admin/users'; $paginationQuery = ['q' => $search]; ?>
    <?php require BASE_PATH . '/app/views/partials/pagination.php'; ?>
  </div>
</section>
