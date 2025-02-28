<?php

namespace Commands;

use App\Interface\CommandInterface;

class MakeController implements CommandInterface
{
    public function handle($args)
    {
        $default_folder =  "/app/Http/Controllers/";
        $folder = isset($args[1]) ? $default_folder . trim($args[0]) : $default_folder;
        $file_name = isset($args[1]) ? $args[1] . '.php' : $args[0] . '.php';
        $namespace = ($folder == $default_folder) ? "" : $folder;

        $full_folder_path = dirname(__DIR__) . $folder;
        if (!file_exists($full_folder_path)) {
            mkdir($full_folder_path, 0777, true);
        }
        
        $full_path = $full_folder_path.'/'. $file_name;
        $content = $this->controllerContent($file_name, $namespace);

        $file = fopen($full_path, 'w');
        fwrite($file, $content);
        fclose($file);

        echo "Controller created successfully.\n";
    }

    public function controllerContent($file_name, $folder_name = "") {
        
        $file_name = str_replace('.php', '', $file_name);
        $class_name = ucfirst($file_name);
        $folder_name = ucfirst($folder_name);

        // Build the namespace
        $namespace = ($folder_name == "") ? "App\Http\Controllers" : "App\Http\Controllers\\" . str_replace("/", "\\", trim(explode("/", $folder_name)[4], "/"));

        $content = "<?php 
        namespace $namespace;
        
        use App\Http\Controllers\Controller;

        class $class_name extends Controller {
            
        }
        ";

        return $content;
    }
}