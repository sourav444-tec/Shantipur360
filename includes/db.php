<?php
/**
 * includes/db.php
 * PDO database connection for Santipur Rash.
 *
 * Edit the constants below if your XAMPP MySQL settings differ.
 * Default XAMPP: user "root", empty password.
 */

declare(strict_types=1);

// ---- Configuration (easy to change) -------------------------------------
const DB_HOST    = 'localhost';
const DB_NAME    = 'santipur_rash';
const DB_USER    = 'root';
const DB_PASS    = '';          // XAMPP default is empty. Set a password in production.
const DB_CHARSET = 'utf8mb4';   // Required for Bengali Unicode
// --------------------------------------------------------------------------

/**
 * Returns a shared PDO connection.
 *
 * @throws RuntimeException with a generic message when the connection fails
 *                          (details are written to the PHP error log only).
 */
function getDatabaseConnection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        $pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
    } catch (PDOException $exception) {
        // Log details privately; never show credentials or SQL errors to visitors.
        error_log('[Santipur Rash] Database connection failed: ' . $exception->getMessage());
        throw new RuntimeException('Database connection is currently unavailable.');
    }

    return $pdo;
}