-- Phụ trách: Thành viên C (thiết kế CSDL chung)
CREATE DATABASE IF NOT EXISTS company_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE company_web;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  avatar VARCHAR(255) NULL,
  role ENUM('member','admin') NOT NULL DEFAULT 'member',
  status ENUM('active','banned') NOT NULL DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
