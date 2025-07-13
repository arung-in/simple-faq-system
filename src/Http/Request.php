<?php

namespace SimpleFaqSystem\Http;

class Request
{

    private static $instance = null;

    private function __construct(
        private array $server,
        private array $get,
        private array $post
    ) 
    {}
    
    public static function create() {
        
        if (null === static::$instance) {
            
            static::$instance = new static(
                $_SERVER,
                $_GET,
                $_POST
            );
        }

        return static::$instance;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function getUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }
    
}