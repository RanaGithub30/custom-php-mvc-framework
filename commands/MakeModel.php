<?php

namespace Commands;

use App\Interface\CommandInterface;

class MakeModel implements CommandInterface{
    public function handle($args)
    {
        $default_folder =  "/app/models";
        $folder = isset($args[1]) ? $default_folder .'/'. trim($args[0]) : $default_folder;
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

        echo "Model created successfully.\n";
    }

    public function controllerContent($file_name, $folder_name = "") {
        
        $file_name = str_replace('.php', '', $file_name);
        $class_name = ucfirst($file_name);
        $folder_name = ucfirst($folder_name);

        // Build the namespace
        $namespace = ($folder_name == "") ? "App\Models" : "App\Models\\" . str_replace("/", "\\", trim(explode("/", $folder_name)[2], "/"));

        $content = "<?php 
        namespace $namespace;

        class $class_name {
            
        }
        ";

        return $content;
    }
}