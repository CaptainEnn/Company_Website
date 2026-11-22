<?php if ($pagination->pages() > 1): ?>
  <nav class="pagination" aria-label="Phân trang">
    <?php if ($pagination->page > 1): ?>
      <a class="button button-secondary" href="<?= e(base_url($paginationPath) . '?' . http_build_query(array_merge($paginationQuery ?? [], ['page' => $pagination->page - 1]))) ?>">Trang trước</a>
    <?php endif; ?>
    <span>Trang <?= e($pagination->page) ?> / <?= e($pagination->pages()) ?></span>
    <?php if ($pagination->page < $pagination->pages()): ?>
      <a class="button button-secondary" href="<?= e(base_url($paginationPath) . '?' . http_build_query(array_merge($paginationQuery ?? [], ['page' => $pagination->page + 1]))) ?>">Trang sau</a>
    <?php endif; ?>
  </nav>
<?php endif; ?>
