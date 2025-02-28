<?php

use Commands\MakeController;
use Commands\MakeModel;
use Commands\ListCommands;

// List of available commands
$commands = [
    'make:controller' => MakeController::class,
    'make:model' => MakeModel::class,
    'list' => ListCommands::class
];

return $commands;