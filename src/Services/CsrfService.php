<?php

namespace SimpleFaqSystem\Services;

class CsrfService
{ 
    private string $sessionKey = 'csrf_token';
    private int $maxTokens = 5;
    
    public function generateToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        
        $token = bin2hex(random_bytes(32));
        
        // Store token in session
        $_SESSION[$this->sessionKey] = $_SESSION[$this->sessionKey] ?? [];
        array_unshift($_SESSION[$this->sessionKey], $token);
        
        // Keep only the last few tokens
        $_SESSION[$this->sessionKey] = array_slice($_SESSION[$this->sessionKey], 0, $this->maxTokens);
        
        return $token;
    }
    
    public function validateToken(string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        
        
        if (empty($_SESSION[$this->sessionKey])) {
            // api call request verification
            return false;
        }
        
        // Check if token exists in session
        $valid = in_array($token, $_SESSION[$this->sessionKey], true);
        
        // Remove the token after validation (one-time use)
        if ($valid) {
            // $_SESSION[$this->sessionKey] = array_diff($_SESSION[$this->sessionKey], [$token]);
        }
        
        return $valid;
    } 
}