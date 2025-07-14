<?php

namespace SimpleFaqSystem\Controllers;

use SimpleFaqSystem\Http\Request;
use SimpleFaqSystem\Http\Response;

abstract class AbstractController
{
    
    protected ?Request $request = null;

    public function render(string $view, array $data = []): Response
    { 

        $templatePath = BASE_PATH . '/views/' . $view . '.php';
        
        if (!file_exists($templatePath)) {
            throw new \Exception("View not found: " . $templatePath);
        }
        
        extract($data);
        ob_start();
        include $templatePath;
        $content = ob_get_clean();

        // $content = "Rendering view: $view with data: " . json_encode($data);
        return new Response($content);
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}