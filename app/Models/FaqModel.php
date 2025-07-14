<?php

namespace App\Models;

use SimpleFaqSystem\Database\Connection;

class FaqModel
{
    private Connection $connection;

    public function __construct()
    {
        $config = include BASE_PATH . '/database/config.php';
        $this->connection = Connection::getInstance($config['database']);
    }

    public function getAllFaqs(): array
    {
        $connection = $this->connection;        
        $stmt = $connection->pdo->query("SELECT * FROM faqs");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFaqById(int $id): ?array
    {
        $stmt = $this->connection->pdo->prepare("SELECT * FROM faqs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function incrementLikeCount(int $id): bool
    {
        $stmt = $this->connection->pdo->prepare("UPDATE faqs SET likes_count = likes_count + 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getLikeCount(int $id): int
    {
        $stmt = $this->connection->pdo->prepare("SELECT likes_count FROM faqs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? (int)$result['likes_count'] : 0;
    }
}