<?php

namespace SimpleFaqSystem\Http;

class Response 
{

    public function __construct(
        private ?string $content = null,
        private int $statusCode = 200,
        private array $headers = []
    ) {
        http_response_code($this->statusCode);
    }

    public function setContent(): void
    {
        echo $this->content;
    }
}