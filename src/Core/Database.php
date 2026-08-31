<?php
namespace App\Core;

class Database
{
    public ?\PDO $pdo = null;

    public function __construct()
    {
        $this->connexionDB();
    }

    public function connexionDB(): \PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new \PDO(
                "pgsql:host=localhost;dbname=heritage_poo;",
                "postgres",
                "postgres"
            );

            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function query(string $sql, bool $single = true): mixed
    {
        $pdo = $this->connexionDB();
        $query = $pdo->query($sql);
        return $single ? $query->fetch() : $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function prepare(string $sql, array $datas): \PDOStatement
    {
        $pdo = $this->connexionDB();
        $prepare = $pdo->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);
        return $single ? $statement->fetch() : $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function executeUpdate(string $sql, array $datas): int|string
    {
        $pdo = $this->connexionDB();
        $statement = $this->prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? $pdo->lastInsertId() : $statement->rowCount();
    }

    public function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return $this->query($sql, false);
    }
}