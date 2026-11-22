# Website Công ty – Doanh nghiệp (BTL Lập trình Web HK1 2026-2027)

PHP thuần (≥ 7.0, **không framework/CMS**), MVC tự viết, MySQL, HTML5/CSS3/JS. Trang quản trị dùng TailAdmin (bản free).

## Thành viên
| TV | Họ tên | MSSV | Email | Công việc riêng |
|----|--------|------|-------|-----------------|
| A |  |  |  | #1 Trang chủ, Liên hệ |
| B |  |  |  | #2 Giới thiệu, Hỏi/đáp |
| C |  |  |  | #3 Sản phẩm, Giỏ hàng |
| D |  |  |  | #4 Tin tức, Bình luận |

## Cài đặt trên XAMPP

1. Bật Apache và MySQL/MariaDB trong XAMPP. Apache cần `mod_rewrite` và `AllowOverride All` cho thư mục website. PHP cần `pdo_mysql` và `fileinfo`.
2. Đặt repo tại `C:\xampp\htdocs\company-website`. Cấu hình VirtualHost với DocumentRoot trỏ vào `public/` nếu dùng tên miền riêng.
3. Mở phpMyAdmin và import từng file trong `database/migrations/` theo thứ tự **001–006**, sau đó import `database/seed.sql`. Với CSDL cũ chỉ có bảng `users` của bộ khung, áp dụng 002–006. Migration 006 chỉ chạy một lần trên mỗi CSDL.
4. Copy `app/config/config.local.example.php` thành `app/config/config.local.php` rồi sửa host, tên CSDL, user, mật khẩu và port nếu cần.
5. Từ thư mục repo, chạy PowerShell để tạo quản trị viên. Thay email và tên theo nhóm.

   ```powershell
   & C:\xampp\php\php.exe scripts/create-admin.php admin@example.test "Quản trị viên"
   ```

   Lệnh tạo và in mật khẩu ngẫu nhiên. Đăng nhập rồi đổi mật khẩu trong **Hồ sơ**.
6. Mở `http://localhost/company-website/public/`. Trang quản trị là `http://localhost/company-website/public/admin/users`. Thư mục `public/uploads/avatars/` cần quyền ghi cho Apache. Đặt `upload_max_filesize=2M` và `post_max_size=4M` hoặc lớn hơn trong `php.ini`, rồi khởi động lại Apache sau khi chỉnh.

Các trang chung đã có gồm đăng ký, đăng nhập, hồ sơ cá nhân và quản lý người dùng. Xem [thiết kế và kịch bản demo](docs/report/phan-chung.md).

## Cấu trúc
```
public/        # document root: index.php, assets/, uploads/
app/core/      # Router, Controller, Model, Database, Auth, Csrf, Validator, Upload, Pagination
app/routes/    # mỗi module một file route
app/controllers/ (+ admin/)   app/models/   app/views/ (+ admin/ TailAdmin)
database/      # migrations + seed
docs/          # phân công, quy trình git, báo cáo
```

## Tài liệu
[Phân công](docs/TASKS.md) · [Quy trình Git](docs/GIT_WORKFLOW.md) · [Đóng góp](CONTRIBUTING.md)
