<?php

namespace SimpleFaqSystem\Database;

use PDO;

class Connection
{
    private static $instance = null;
    public ?PDO $pdo = null;

    public function __construct(array $config)
    {
        $dsn = 'mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['name'] . ';charset=utf8';
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            dd('Database connection failed: Please check your database configuration.');
            // throw new \RuntimeException('Database connection failed: ' . $e->getMessage());
        }
    } 

    public static function getInstance(array $config): static
    {
        if (self::$instance === null) {
            self::$instance = new static ($config);
            // self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}