<?php
namespace App\Core;

abstract class Database
{
    private static ?\PDO $pdo = null;

    public function __construct()
    {
        $this->connexionDB();
    }

    public static function connexionDB(): \PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new \PDO(
                "pgsql:host=localhost;dbname=heritage_poo;",
                "postgres",
                "postgres"
            );

            self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}