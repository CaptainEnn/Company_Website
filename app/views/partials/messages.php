<?php foreach ($_SESSION['flash'] ?? [] as $kind => $message): ?>
  <p class="notice <?= $kind === 'success' ? 'notice-success' : 'notice-error' ?>" role="status"><?= e($message) ?></p>
<?php endforeach; ?>
<?php unset($_SESSION['flash']); ?>
<?php if (!empty($errors)): ?>
  <div class="notice notice-error" role="alert">
    <p>Vui lòng kiểm tra thông tin sau.</p>
    <ul>
      <?php foreach ($errors as $message): ?><li><?= e($message) ?></li><?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
