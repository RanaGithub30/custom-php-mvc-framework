<?php

require_once __DIR__.'/database/database.php';

$port = 8000; // Change the port if needed
$host = '127.0.0.1'; // Localhost

// Test database connection
try {
    $pdo->query("SELECT 1"); // Simple query to check connection
    echo "Database connected successfully!\n";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

echo "Starting PHP Server on http://$host:$port\n";

// Run the built-in PHP server in the current directory
exec("php -S $host:$port -t main");