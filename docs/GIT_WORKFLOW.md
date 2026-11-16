# Quy trình Git của nhóm

## Nhánh
- `main`: bản ổn định, dùng để nộp/demo. **Cấm push trực tiếp.**
- `develop`: nhánh tích hợp. Mọi feature merge vào đây qua Pull Request.
- `feature/<tv>-<tinh-nang>`: vd `feature/c-product-crud`, `feature/b-login`.
- `fix/<tv>-<mo-ta>`: sửa lỗi.

## Bắt đầu
```bash
git clone <url-repo>
cd company-website
git checkout develop
git checkout -b feature/a-home-page
```

## Hằng ngày
```bash
git pull origin develop
# ... code ...
git add .
git commit -m "feat(home): thêm carousel trang chủ"
git push -u origin feature/a-home-page
```
Sau đó mở **Pull Request** vào `develop`, nhờ ≥ 1 bạn review rồi merge.

## Quy ước commit
`<type>(<scope>): <mô tả>` với type: `feat`, `fix`, `docs`, `style`, `refactor`, `chore`.

## Tránh conflict
- Mỗi người **chỉ sửa file thuộc module của mình** (controller/model/view/route riêng).
- Route: sửa trong `app/routes/<module>.php`, không dồn vào một file.
- Migration SQL: mỗi nhóm bảng một file đánh số, không sửa file của người khác.
- File chung (`core/`, `layouts/`, `style.css`): báo nhóm trước, PR nhỏ, merge nhanh.
- Luôn `git pull origin develop` trước khi mở PR.

## Thiết lập repo (1 người làm)
1. Tạo repo private trên GitHub/GitLab, thêm 3 thành viên còn lại.
2. Push `main`, tạo `develop`.
3. Settings → Branches: bảo vệ `main` và `develop` (yêu cầu Pull Request + 1 approval).
