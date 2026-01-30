<?php
// Local Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'movie_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// College Database Configuration
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'np03cs4a240092');
// define('DB_USER', 'np03cs4a240092');
// define('DB_PASS', 'DDT6D54YCm');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>