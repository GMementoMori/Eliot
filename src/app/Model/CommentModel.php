<?php
namespace App\Model;

use App\Model\Interface\Model;
use PDO;

class CommentModel implements Model
{
    private Database $db;

    private const TABLE_NAME = 'comments';

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function addComment(string $comment, string $email): int
    {
        $comment = $this->db->sanitizeValue($comment);
        $email = $this->db->sanitizeValue($email);

        $query = "INSERT INTO " . static::TABLE_NAME . " (comment, user_email) VALUES (:comment, :user_email)";
        $statement = $this->db->prepare($query);
        $this->db->execute($statement, [':comment' => $comment, ':user_email' => $email]);
        return $this->db->getLastInsertId();
    }

    public function getBy(array $params): ?array
    {
        $params = $this->db->sanitizeData($params);

        $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE ";
        $conditions = [];
        $bindings = [];

        foreach ($params as $column => $value) {
            $conditions[] = "$column = :$column";
            $bindings[":$column"] = $value;
        }

        $query .= implode(' AND ', $conditions);
        $statement = $this->db->prepare($query);
        $statement->execute($bindings);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComments(int $limit = 10): ?array
    {
        $sql = "SELECT * FROM " . static::TABLE_NAME . " LIMIT :limit";

        $statement = $this->db->prepare($sql);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $this->db->fetchAll($statement);
    }

    public function getPaginatedComments(int $page = 1, int $limit = 10): ?array
    {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM " . static::TABLE_NAME . " LIMIT :offset, :limit";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        $comments = $this->db->fetchAll($statement);

        $totalCount = $this->getTotalCommentsCount();

        $totalPages = ceil($totalCount / $limit);

        return [
            'comments' => $comments,
            'totalPages' => $totalPages,
        ];
    }

    private function getTotalCommentsCount(): int
    {
        $sql = "SELECT COUNT(*) FROM " . static::TABLE_NAME;
        $statement = $this->db->query($sql);
        return (int)$statement->fetchColumn();
    }
}
