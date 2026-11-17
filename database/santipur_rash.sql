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