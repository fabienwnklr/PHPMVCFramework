<?php

namespace app\core;

use app\core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;
    
    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName ( " . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");


        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        
        return true;
    }

    /**
     * shortcut to prepapre sql
     *
     * @param string $sql
     * @return \PDOStatement|false
     */
    public static function prepare(string $sql): \PDOStatement|false
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}