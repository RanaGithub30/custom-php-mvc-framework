<?php

namespace Commands;

use App\Interface\CommandInterface;

class MakeMigration implements CommandInterface
{
    public function handle($args)
    {
        $default_folder =  "/database/migrations/";
        $folder = isset($args[1]) ? $default_folder . trim($args[0]) : $default_folder;
        $file_prefix = date('d_m_Y').'_'.time().'_';
        $file_name = isset($args[1]) ? $file_prefix.$this->camelToSnake($args[1]) . '.php' : $file_prefix.$this->camelToSnake($args[0]) . '.php';
        $namespace = ($folder == $default_folder) ? "" : $folder;
        $class_name = isset($args[1]) ? $args[1] : $args[0];

        $full_folder_path = dirname(__DIR__) . $folder;
        if (!file_exists($full_folder_path)) {
            mkdir($full_folder_path, 0777, true);
        }
        
        $full_path = $full_folder_path.'/'. $file_name;
        $content = $this->migrationContent($class_name, $namespace);

        $file = fopen($full_path, 'w');
        fwrite($file, $content);
        fclose($file);

        echo "Migration [$full_path] created successfully.\n";
    }

    public function migrationContent($file_name, $namespace, $folder_name = ""){
        $file_name = str_replace('.php', '', $file_name);
        $class_name = ucfirst($file_name);
        $folder_name = ucfirst($folder_name);
        $table = '$table';

        // Build the namespace
        $namespace = ($folder_name == "") ? "App\Http\Controllers" : 
        "App\Http\Controllers\\" . str_replace("/", "\\", trim(explode("/", $folder_name)[4], "/"));

$content = "<?php 
namespace $namespace;

class $class_name {
protected static $table = '';

public static function up() {

}

public static function down() {

}
}
";

        return $content;
    }

public function camelToSnake($input) {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
}
    
}