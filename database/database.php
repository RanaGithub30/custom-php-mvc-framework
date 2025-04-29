<?php

require_once dirname(__DIR__).'../config.php'; // Include the helper file

// Load environment variables
loadEnv(dirname(__DIR__) . '/.env');

// Database connection using PDO
try {
    $pdo = new PDO(
        "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS')
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}