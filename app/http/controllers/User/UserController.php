<?php

namespace App\Http\Controllers\User;

require_once dirname(__DIR__) . '/Controller.php';
require_once dirname(__DIR__, 3) . '/models/User.php';

use App\Http\Controllers\Controller;
use App\models\User;

class UserController extends Controller{
        public function index(){
                return $this->View("auth/login.php");
        }
        
        public function register(){
                return $this->View("auth/register.php");
        }

        public function registerAction($request = ""){
                $uname = $request['uname'];
                $email = $request['email'];
                // $password = $request['psw'];
                $password = password_hash($request['psw'], PASSWORD_BCRYPT); 

                $createUser = User::store(
                        'uname, email, password',
                        [$uname, $email, $password]
                );

                if($createUser === true){
                        return $this->View("auth/login.php");
                }
                else{
                        return $this->View("auth/register.php");
                }
        }

        public function getAllUsers(){
                $users = User::allData('users');
                return $this->View("auth/all_users.php", ['users' => $users]);
        }
}