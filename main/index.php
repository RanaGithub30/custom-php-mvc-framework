<?php

require_once __DIR__ . '/../routes/web.php';
use App\Router; // Add this

Router::dispatch($_SERVER['REQUEST_URI']); // ✅ Dispatch request