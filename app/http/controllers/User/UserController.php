<?php

namespace App\Http\Controllers\User;

require_once dirname(__DIR__) . '/Controller.php';
use App\Http\Controllers\Controller;

class UserController extends Controller{
        public function index(){
                return $this->View("auth/login.php");
        }
        
        public function register(){
                return $this->View("auth/register.php");
        }
}