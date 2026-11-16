# Phân công công việc

Quy ước: **A, B, C, D** = 4 thành viên. Mỗi người nhận **1 công việc riêng (#1–#4)** + **1 phần công việc chung**.

## Công việc riêng (theo đề bài)

| TV | Việc | Giao diện | Quản trị (TailAdmin) | Branch |
|----|------|-----------|----------------------|--------|
| A | #1 | Trang chủ, Liên hệ | Quản lý nội dung trang (logo, SĐT, địa chỉ, ảnh…); quản lý liên hệ (đã đọc/chưa đọc/đã phản hồi/xoá) | `feature/a-*` |
| B | #2 | Giới thiệu, Hỏi/đáp | Quản lý nội dung trang Giới thiệu; CRUD Hỏi/đáp | `feature/b-*` |
| C | #3 | Danh sách sản phẩm (tìm kiếm), chi tiết SP / giỏ hàng | CRUD sản phẩm (có tìm kiếm); quản lý giỏ hàng, đơn hàng, trạng thái | `feature/c-*` |
| D | #4 | Danh sách bài viết (tìm kiếm), đọc bài viết | CRUD tin tức (SEO: title, keywords, description); quản lý bình luận | `feature/d-*` |

## Công việc chung (đề xuất chia)

| TV | Phần chung | Ghi chú |
|----|-----------|---------|
| A | Thiết kế mô hình ứng dụng (MVC, router, core) + **template chung** (header/footer/layout) | Bộ khung đã có sẵn, A hoàn thiện & viết tài liệu |
| B | **Đăng ký / đăng nhập**, phân quyền (guest/member/admin) | `AuthController`, `Auth`, `Validator` |
| C | **Thiết kế CSDL quan hệ** (ERD, tổng hợp migration) + **quản lý người dùng** cho admin (xem, reset mật khẩu, khoá, xoá) | Chốt schema sớm ở tuần 1 |
| D | **Hồ sơ cá nhân**: đổi thông tin, mật khẩu, avatar | `ProfileController`, dùng `Upload` |

## Yêu cầu chéo (mọi người đều làm)
- Validate cả client (JS) và server (PHP); form có CSRF token
- Prepared statement (PDO), escape output bằng `e()`
- Phân trang cho các trang danh sách/quản trị
- Upload ảnh lên server (không dùng URL ngoài)
- HTML/CSS qua W3C validator, responsive, test nhiều trình duyệt
- Viết báo cáo phần của mình trong `docs/report/<ten-thanh-vien>.md`

## Mốc thời gian gợi ý
1. **Tuần 1**: chốt ERD, layout chung, migration 001; mỗi người dựng giao diện HTML/CSS tĩnh (nộp lần 1 lên LMS)
2. **Tuần 2–3**: Auth + Profile + Admin user; các module riêng (backend)
3. **Tuần 4**: tích hợp, phân trang, SEO, bảo mật, test
4. **Tuần cuối**: báo cáo ≥ 20 trang, chuẩn bị demo
