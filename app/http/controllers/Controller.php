<?php

namespace App\Http\Controllers;

class Controller{
    
    public function View($page) {
        // Get the base directory for views
        $baseDir = (dirname(__DIR__, 3) . '/resources/views');
        
        // Construct the full path to the requested page
        $filePath = $baseDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $page);

        // Check if file exists and is within the views directory (security check)
        if ($filePath && strpos($filePath, $baseDir) === 0 && file_exists($filePath)) {
            include $filePath;  // Load the file instead of redirecting
        } else {
            die("Error: View file not found.");
        }
    }
}