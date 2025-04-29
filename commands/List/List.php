<?php

use Commands\MakeController;
use Commands\MakeModel;
use Commands\ListCommands;
use Commands\MakeMigration;

// List of available commands
$commands = [
    'make:controller' => MakeController::class,
    'make:model' => MakeModel::class,
    'make:migration' => MakeMigration::class,
    'list' => ListCommands::class
];

return $commands;