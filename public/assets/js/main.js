'use strict';

document.querySelectorAll('form').forEach((form) => {
  const password = form.querySelector('[data-new-password]');
  const confirmation = form.querySelector('[data-confirm-password]');
  const name = form.querySelector('input[name="name"]');
  const phone = form.querySelector('[data-phone]');
  const image = form.querySelector('[data-image-limit]');
  const email = form.querySelector('input[name="email"]');
  const emailPassword = form.querySelector('[data-email-password]');

  function validate() {
    if (name) {
      name.setCustomValidity(name.value && !name.value.trim() ? 'Họ tên không được để trống.' : '');
    }
    if (password && confirmation) {
      const tooLong = new TextEncoder().encode(password.value).length > 72;
      password.setCustomValidity(tooLong ? 'Mật khẩu vượt quá 72 byte.' : '');
      confirmation.setCustomValidity(confirmation.value && confirmation.value !== password.value
        ? 'Mật khẩu xác nhận không trùng khớp.' : '');
    }
    if (phone) {
      const number = phone.value.trim();
      phone.setCustomValidity(number && !/^[+0-9][0-9 ().-]{6,24}$/.test(number)
        ? 'Số điện thoại không hợp lệ.' : '');
    }
    if (image) {
      const file = image.files[0];
      const allowed = ['image/jpeg', 'image/png', 'image/webp'];
      const invalid = file && ((file.type && !allowed.includes(file.type))
        || file.size > Number(image.dataset.imageLimit));
      image.setCustomValidity(invalid ? 'Vui lòng chọn ảnh đúng loại và dung lượng.' : '');
    }
    if (emailPassword && email) {
      emailPassword.required = email.value.trim().toLowerCase() !== emailPassword.dataset.originalEmail.toLowerCase();
    }
  }

  form.addEventListener('input', validate);
  form.addEventListener('change', validate);
  form.addEventListener('submit', (event) => {
    validate();
    if (!form.reportValidity()) event.preventDefault();
  });
});
