# Website Công ty – Doanh nghiệp (BTL Lập trình Web HK1 2026-2027)

PHP thuần (≥ 7.0, **không framework/CMS**), MVC tự viết, MySQL, HTML5/CSS3/JS. Trang quản trị dùng TailAdmin (bản free).

## Thành viên
| TV | Họ tên | MSSV | Email | Công việc riêng |
|----|--------|------|-------|-----------------|
| A |  |  |  | #1 Trang chủ, Liên hệ |
| B |  |  |  | #2 Giới thiệu, Hỏi/đáp |
| C |  |  |  | #3 Sản phẩm, Giỏ hàng |
| D |  |  |  | #4 Tin tức, Bình luận |

## Cài đặt
1. Cài XAMPP/Laragon (PHP ≥ 7.0, MySQL, Apache bật `mod_rewrite`).
2. Clone repo vào thư mục web (vd `htdocs/company-website`).
3. Import CSDL: chạy lần lượt `database/migrations/001 → 005`, rồi `database/seed.sql`.
4. Copy `app/config/config.local.example.php` → `app/config/config.local.php`, sửa thông tin DB.
5. Mở `http://localhost/company-website/public/`
   (khuyến nghị trỏ VirtualHost DocumentRoot vào `public/`).

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
