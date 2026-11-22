<label for="password"><?= e($passwordLabel ?? 'Mật khẩu mới') ?></label>
<input id="password" name="password" type="password" minlength="8" maxlength="72" required
  autocomplete="new-password" data-new-password aria-describedby="password-rules">
<small id="password-rules">Ít nhất 8 ký tự, tối đa 72 byte.</small>
<label for="confirmation">Xác nhận mật khẩu</label>
<input id="confirmation" name="confirmation" type="password" required
  autocomplete="new-password" data-confirm-password>
