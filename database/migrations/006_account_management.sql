USE company_web;

ALTER TABLE users
  ADD COLUMN phone VARCHAR(25) NULL AFTER email,
  ADD COLUMN session_version INT UNSIGNED NOT NULL DEFAULT 1,
  ADD COLUMN must_change_password TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN deleted_at DATETIME NULL,
  ADD INDEX users_directory (role, deleted_at, id);
