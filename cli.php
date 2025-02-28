#!/usr/bin/env php
<?php

require_once __DIR__ . '/app/interface/CommandInterface.php';

// Load commands from separate file
$commands = require __DIR__ . '/commands/List/List.php';

// Autoload commands dynamically
spl_autoload_register(function ($class) {
    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . "/$class.php";

    if (file_exists($file)) {
        require_once $file;
    }
});


// Get the command name
$command = $argv[1] ?? null;
$args = array_slice($argv, 2);

if (!$command) {
    echo "Usage: php cli.php [command] [arguments]\n";
    echo "Available commands:\n";
    foreach (array_keys($commands) as $cmd) {
        echo "  - $cmd\n";
    }
    exit(1);
}

// Execute the command if it exists
if (isset($commands[$command])) {
    $className = $commands[$command];
    $cmdInstance = new $className();
    $cmdInstance->handle($args);
} else {
    echo "Command not found: $command\n";
    exit(1);
}