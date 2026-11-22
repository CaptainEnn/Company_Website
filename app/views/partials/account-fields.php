<label for="name">Họ tên</label>
<input id="name" name="name" value="<?= e($values['name'] ?? '') ?>" required maxlength="100" autocomplete="name">
<label for="email">Email</label>
<input id="email" name="email" type="email" value="<?= e($values['email'] ?? '') ?>" required maxlength="150" autocomplete="email">
<?php if (!empty($showPhone)): ?>
  <label for="phone">Số điện thoại</label>
  <input id="phone" name="phone" type="tel" value="<?= e($values['phone'] ?? '') ?>"
    minlength="7" maxlength="25" autocomplete="tel" data-phone>
<?php endif; ?>
