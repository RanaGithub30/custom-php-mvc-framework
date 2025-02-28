<?php

$port = 8000; // Change the port if needed
$host = '127.0.0.1'; // Localhost

echo "Starting PHP Server on http://$host:$port\n";

// Run the built-in PHP server in the current directory
exec("php -S $host:$port -t main");