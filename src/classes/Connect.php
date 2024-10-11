<?php

namespace Classes;

class Connect
{
    private static $pdo = null;

    // Сделаем подключение к Б\Д статическим, чтобы не создавать объект
    public static function getConnection()
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new \PDO('mysql:host=localhost;dbname=pizza_db', 'root', 'Gzasdgzasd');
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}