Xem [docs/GIT_WORKFLOW.md](docs/GIT_WORKFLOW.md) và [docs/TASKS.md](docs/TASKS.md).

Checklist trước khi mở Pull Request:
- [ ] Chạy được local, không lỗi PHP notice/warning
- [ ] Validate client + server, có CSRF cho form POST
- [ ] Query dùng prepared statement, output dùng `e()`
- [ ] HTML qua W3C validator, responsive
- [ ] Không commit file upload, `.env`, `config.local.php`
