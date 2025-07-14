<?php

namespace SimpleFaqSystem\Http;

use SimpleFaqSystem\Services\CsrfService;

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
     
    public function input(string $key, $default = null)
    {
        return $this->input[$key] ?? $default;
    }

    public function getCsrfToken(): ?string
    {
        return $this->input('_csrf_token') ?? null;
    }

    public function validateCsrfToken(CsrfService $csrfService): bool
    {
        $token = $this->getCsrfToken();
        
        return $token && $csrfService->validateToken($token);
    }
}