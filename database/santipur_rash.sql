-- =====================================================================
-- Santipur Rash – database schema
-- Import via phpMyAdmin: http://localhost/phpmyadmin  ->  Import
-- Requires MySQL 5.7+ / MariaDB 10.2+ (bundled with current XAMPP)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `santipur_rash`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `santipur_rash`;

CREATE TABLE IF NOT EXISTS `feedback` (
    `id`           INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `visitor_name` VARCHAR(100)     NOT NULL,
    `email`        VARCHAR(150)     NOT NULL,
    `phone`        VARCHAR(20)      DEFAULT NULL,
    `category`     VARCHAR(30)      NOT NULL,
    `rating`       TINYINT UNSIGNED NOT NULL,
    `message`      TEXT             NOT NULL,
    `created_at`   TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_feedback_created_at` (`created_at`),
    KEY `idx_feedback_category` (`category`),
    KEY `idx_feedback_rating` (`rating`),
    CONSTRAINT `chk_feedback_rating` CHECK (`rating` BETWEEN 1 AND 5)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `admins` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `username` VARCHAR(80) NOT NULL UNIQUE,
 `password_hash` VARCHAR(255) NOT NULL, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `festival_places` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `name` VARCHAR(180) NOT NULL,
 `category` ENUM('pandal','bigraha','transport','helpline','other') NOT NULL DEFAULT 'other',
 `description` TEXT DEFAULT NULL, `address` VARCHAR(255) DEFAULT NULL, `phone` VARCHAR(30) DEFAULT NULL,
 `latitude` DECIMAL(10,7) NOT NULL, `longitude` DECIMAL(10,7) NOT NULL,
 `image` VARCHAR(255) DEFAULT NULL, `is_published` TINYINT(1) NOT NULL DEFAULT 1,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`), KEY `idx_places_category` (`category`), KEY `idx_places_published` (`is_published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `gallery` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `title` VARCHAR(180) NOT NULL,
 `caption` VARCHAR(255) DEFAULT NULL, `image` VARCHAR(255) NOT NULL,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `feedback_attachments` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `feedback_id` INT UNSIGNED NOT NULL,
 `file_path` VARCHAR(255) NOT NULL, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`), KEY `idx_feedback_attachment_parent` (`feedback_id`),
 CONSTRAINT `fk_feedback_attachment_parent` FOREIGN KEY (`feedback_id`) REFERENCES `feedback`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Admin accounts (passwords are stored as PHP password_hash values).
CREATE TABLE IF NOT EXISTS admins (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 username VARCHAR(80) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Public directory items and map coordinates.
CREATE TABLE IF NOT EXISTS festival_places (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 name VARCHAR(180) NOT NULL,
 category ENUM('pandal','bigraha','transport','helpline','other') NOT NULL DEFAULT 'other',
 description TEXT NULL,
 address VARCHAR(255) NULL,
 phone VARCHAR(30) NULL,
 latitude DECIMAL(10,7) NOT NULL,
 longitude DECIMAL(10,7) NOT NULL,
 image VARCHAR(255) NULL,
 is_published TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY(id), KEY idx_category(category), KEY idx_published(is_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS gallery (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 title VARCHAR(180) NOT NULL,
 caption VARCHAR(255) NULL,
 image VARCHAR(255) NOT NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
