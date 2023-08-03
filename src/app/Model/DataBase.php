<?php
namespace App\Model;

use PDO;
use PDOException;
use PDOStatement;

class DataBase
{
    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    public function query($query): PDOStatement
    {
        return $this->pdo->query($query);
    }

    public function prepare($query): PDOStatement
    {
        return $this->pdo->prepare($query);
    }

    public function execute($statement, $params = []): bool
    {
        return $statement->execute($params);
    }

    public function fetchAll($statement): array
    {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }

    public function sanitizeData(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->sanitizeValue($value);
        }
        return $data;
    }

    public function sanitizeValue(string $value): string
    {
        return $this->pdo->quote($value);
    }
}

