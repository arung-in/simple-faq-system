<?php

namespace App\Controllers;

use SimpleFaqSystem\Controllers\AbstractController;
use SimpleFaqSystem\Http\Response;

class FaqController extends AbstractController
{
    public function index(): Response
    {

        $data = [
            'title' => 'Simple FAQ System MVC framework - Welcomes you',
        ];
    
        return $this->render('home', $data );
        
    }

    public function faqLike($id)
    {
        
        $content = "Welcome to the FAQ Like System!" . " FAQ ID: " . $id;
        $response = new Response($content);         
        return $response;
    }
}