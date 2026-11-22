USE company_web;

INSERT INTO site_settings (setting_key, setting_value) VALUES
  ('company_name', 'Company Website'),
  ('contact_email', 'contact@example.com')
ON DUPLICATE KEY UPDATE setting_value = site_settings.setting_value;
-- Tạo admin bằng scripts/create-admin.php để tránh tài khoản mặc định dùng chung.
