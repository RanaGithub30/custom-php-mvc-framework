<?php 
// User.php
namespace App\Models;

require_once __DIR__ . '/Model.php';
use App\Models\Model;

class User extends Model {
    protected static $table = 'users';

    public static function store($fields, $values){
        return parent::create(self::$table, $fields, $values); 
    }

    public static function allData(){
        return parent::all(self::$table);
    }
}