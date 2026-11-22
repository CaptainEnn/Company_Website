<aside class="flex w-full flex-col border-b border-gray-200 bg-white px-5 py-5 lg:w-72 lg:border-r lg:border-b-0">
  <div class="mb-4 text-lg font-semibold text-gray-800"><?= e(config('app.name')) ?></div>
  <nav aria-label="Quản trị">
    <ul>
      <li>
        <a class="menu-item menu-item-active" href="<?= e(base_url('admin/users')) ?>">
          <span class="menu-item-text">Người dùng</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>
