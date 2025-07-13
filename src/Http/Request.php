<?php

namespace SimpleFaqSystem\Http;

class Request
{

    private static $instance = null;
    private array $attributes = [];

    private function __construct(
        private array $server,
        private array $get,
        private array $post,
        private array $input
    ) 
    {}
    
    public static function create() {
        
        if (null === static::$instance) {
            
            $input = [];
            if (str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json')) {
                $input = json_decode(file_get_contents('php://input'), true) ?? [];
            }

            static::$instance = new static(
                $_SERVER,
                $_GET,
                $_POST,
                $input
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
        $uri = $this->server['REQUEST_URI'] ?? '/';
        // Strip query string from URI
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }
        
        return $uri;
        // return parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    }
    
    // public function get(string $key, $default = null)
    // {
    //     return $this->get[$key] ?? $default;
    // }
    
    // public function post(string $key, $default = null)
    // {
    //     return $this->post[$key] ?? $default;
    // }
    
    // public function input(string $key, $default = null)
    // {
    //     return $this->input[$key] ?? $default;
    // }
    
    // public function getFaqId(): ?int
    // {
    //     // Check all possible sources for faqId
    //     return $this->get('faqId') 
    //         ?? $this->post('faqId') 
    //         ?? $this->input('faqId') 
    //         ?? null;
    // }
    
    // public function setAttribute(string $key, $value): void
    // {
    //     $this->attributes[$key] = $value;
    // }
    
    // public function getAttribute(string $key, $default = null)
    // {
    //     return $this->attributes[$key] ?? $default;
    // }


    public function setAttribute(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute(string $key, $default = null)
    {
        return $this->attributes[$key] ?? $default;
    }

    public function input(string $key, $default = null)
    {
        return $this->input[$key] ?? $default;
    }
}