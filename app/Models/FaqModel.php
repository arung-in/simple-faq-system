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
}