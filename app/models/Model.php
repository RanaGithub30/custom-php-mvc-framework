<?php

namespace App\Models;

use App\database\Database;

class Model
{
    protected $table;

    public static function connection()
    {
        $conn = require(dirname(__DIR__, 2) . '/database/database.php');
        
        if (!$conn instanceof \PDO) {
            die("❌ Database connection failed or not returning PDO instance.");
        }

        return $conn;
    }

    public function getTable()
    {
        return $this->table;
    }

    /** Create a Row */

    public static function create($table, $fields, $values)
    {
        $conn = self::connection(); // PDO connection
        self::createTable($table, $fields); // Ensure table exists

        $columns = explode(",", $fields);
        $columns = array_map('trim', $columns); // Clean spaces

        // Create placeholders for prepared statement
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        $placeholdersString = implode(', ', $placeholders);
        $fieldsString = implode(', ', $columns);

        $sql = "INSERT INTO $table ($fieldsString) VALUES ($placeholdersString)";

        try {
            $stmt = $conn->prepare($sql);

            // Combine columns and values for binding
            foreach ($columns as $index => $column) {
                $stmt->bindValue(':' . $column, $values[$index] ?? null);
            }

            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function all($table){
        $conn = self::connection();
        $sql = "SELECT * FROM $table";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Create a Table **/

    public static function createTable($table, $fields)
    {
        $conn = self::connection();

        $columns = explode(",", $fields);
        $columns = array_map('trim', $columns);

        $formattedFields = [];

        foreach ($columns as $column) {
            $formattedFields[] = "`$column` VARCHAR(255) NOT NULL";
        }

        $fieldsString = implode(", ", $formattedFields);

        $sql = "CREATE TABLE IF NOT EXISTS `$table` (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            $fieldsString,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        try {
            $conn->exec($sql); // PDO's exec() for CREATE
            return true;
        } catch (\PDOException $e) {
            return "Table creation error: " . $e->getMessage();
        }
    }
}