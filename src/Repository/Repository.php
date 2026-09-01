<?php
namespace App\Model;

use App\Core\Database;

abstract class Repository{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connexionDB();
    }

     public function query(string $sql, bool $single = true): mixed
    {
        $query = $this->pdo->query($sql);
        return $single ? $query->fetch() : $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function prepare(string $sql, array $datas): \PDOStatement
    {
        $prepare = $this->pdo->prepare($sql);
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
        $statement = $this->prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? $this->pdo->lastInsertId() : $statement->rowCount();
    }

    public function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return $this->query($sql, false);
    }
}