<?php

namespace SimpleFaqSystem\Http\Middleware;

use SimpleFaqSystem\Http\Request;
use SimpleFaqSystem\Http\Response;
use SimpleFaqSystem\Services\CsrfService;

class CsrfMiddleware
{
    private CsrfService $csrfService;

    public function __construct(CsrfService $csrfService)
    {
        $this->csrfService = $csrfService;
    }

    public function handle(Request $request, callable $next)
    { 
        
        
        // Check if the request method is POST and validate CSRF token
        if (in_array($request->getMethod(), ['GET', 'HEAD', 'OPTIONS'])) {
            return $next($request);
        }

        $token = $request->input('_csrf_token') ?? '';

        // Verify the token
        if (!$token || !$this->csrfService->validateToken($token)) {
            return new Response(
                json_encode(['error' => 'Invalid CSRF Token']), 
                403,
                ['Content-Type' => 'application/json']
            );
        }
 
        return $next($request);
    }
}