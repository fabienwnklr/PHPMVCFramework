<?php

use app\core\Application;

class m0001_initial
{
    public function up(): string
    {
        try {
            $db = Application::$app->db;

            // TODO
            $db->createTable('users', [
                ["name" => "firstname" ,"type" => 'varchar(255)', "constraint" => 'NOT NULL'],
                ["name" => "lastname", "type" => 'varchar(255)', "constraint" => 'NOT NULL'],
                ["name" => "email", "type" => 'varchar(255)', "constraint" => 'NOT NULL'],
                ["name" => "password","type" => 'varchar(255)', "constraint" => 'NOT NULL']
            ]);

            return '';
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE users";
        $db->pdo->exec($SQL);
    }
}
