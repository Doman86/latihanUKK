-- =========================================================
-- DATABASE: katalog_produk
-- Project: Web Katalog Produk (UKK) - Client Server
-- Tables : users, products, comments
-- =========================================================

CREATE DATABASE IF NOT EXISTS `katalog_produk`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `katalog_produk`;

-- ---------------------------------------------------------
-- Table: users
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------
-- Table: products
-- ---------------------------------------------------------
CREATE TABLE `products` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT 'admin yang menambahkan produk',
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT NULL,
  `price` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `image` VARCHAR(255) NULL COMMENT 'path/nama file foto produk',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------
-- Table: comments
-- ---------------------------------------------------------
CREATE TABLE `comments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `comment` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_product_id_foreign` (`product_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_product_id_foreign`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `comments_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- DATA DUMMY (SEEDER)
-- Password asli semua akun di bawah: "password"
-- Hash berikut dibuat pakai bcrypt (10 rounds) via Laravel Hash::make
-- =========================================================

INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Admin Icha', 'admin@katalog.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Ahnaf User', 'ahnaf@katalog.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Budi Santoso', 'budi@katalog.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

INSERT INTO `products` (`user_id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Kaos Polos Combed 30s', 'Kaos polos bahan combed 30s, nyaman dipakai sehari-hari.', 75000.00, 'products/kaos-polos.jpg'),
(1, 'Sepatu Sneakers Casual', 'Sepatu sneakers casual cocok untuk jalan-jalan maupun kuliah.', 250000.00, 'products/sneakers.jpg'),
(1, 'Tas Ransel Laptop', 'Tas ransel muat laptop 14 inch, tahan air.', 180000.00, 'products/tas-ransel.jpg'),
(1, 'Jaket Hoodie Fleece', 'Hoodie fleece tebal dan hangat, cocok untuk cuaca dingin.', 150000.00, 'products/hoodie.jpg'),
(1, 'Topi Baseball Cap', 'Topi baseball cap adjustable, bahan katun.', 45000.00, 'products/topi.jpg');

INSERT INTO `comments` (`product_id`, `user_id`, `comment`) VALUES
(1, 2, 'Bahannya adem banget, recommended!'),
(1, 3, 'Ukurannya pas, sesuai deskripsi.'),
(2, 2, 'Sneakersnya nyaman dipakai lama.'),
(3, 3, 'Tas nya awet dan muat banyak barang.'),
(4, 2, 'Hoodie nya hangat, cocok buat musim hujan.');
