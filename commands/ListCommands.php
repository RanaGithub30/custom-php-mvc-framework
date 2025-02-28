<?php

namespace Commands;

class ListCommands{
    public function handle($args = [])
    {
        $commands = require __DIR__ . '/List/List.php'; // Load all commands

        echo "Available Commands:\n";
        foreach ($commands as $command => $class) {
            echo "  - $command\n";
        }
    }
}