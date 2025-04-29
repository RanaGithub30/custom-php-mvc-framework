<?php

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/http/controllers/User/UserController.php';

use App\Router;
use App\Http\Controllers\User\UserController; 

Router::get('/', [UserController::class, 'index']);
Router::get('/register', [UserController::class, 'register']);
Router::post('/register/action', [UserController::class, 'registerAction']);
Router::get('/get/all/users', [UserController::class, 'getAllUsers']);