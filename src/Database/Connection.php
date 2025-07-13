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
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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