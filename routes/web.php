<?php

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/http/controllers/User/UserController.php';

use App\Router;
use App\Http\Controllers\User\UserController; 

Router::get('/', [UserController::class, 'index']);
Router::get('/test', [UserController::class, 'test']);