<?php

namespace App\Controllers;

use SimpleFaqSystem\Controllers\AbstractController;
use SimpleFaqSystem\Http\Response;
use SimpleFaqSystem\Http\Request;
use App\Models\FaqModel;
use LDAP\Result;

class FaqController extends AbstractController
{
    public function index(): Response
    {
 
        $faqModel = new FaqModel();
        $faqs = $faqModel->getAllFaqs(); 

        $data = [
            'title' => 'Simple FAQ System MVC framework - Welcomes you',
            'faqs' => $faqs,
        ];
    
        return $this->render('home', $data );
        
    }

    public function faqLike(Request $request) : Response
    {
        $faqId = $request->getAttribute('faqId') ?? $request->input('faqId');
        if (!$faqId) {
        
            return new Response(
                json_encode(['success' => false, 'message' => 'FAQ ID is required']),
                400,
                ['Content-Type' => 'application/json']
            );
        }

        // Process the like
    $faqModel = new FaqModel();
    try {
        $success = $faqModel->incrementLikeCount((int)$faqId);
        
        if ($success) {
            $newCount = $faqModel->getLikeCount((int)$faqId);
            return new Response(
                json_encode(['success' => true, 'newCount' => $newCount]),
                200,
                ['Content-Type' => 'application/json']
            );
        }
        
        return new Response(
            json_encode(['success' => false, 'message' => 'Failed to update like count']),
            500,
            ['Content-Type' => 'application/json']
        );
        
        } catch (\Exception $e) {
            return new Response(
                json_encode(['success' => false, 'message' => $e->getMessage()]),
                500,
                ['Content-Type' => 'application/json']
            );
        }

        // if (!$faqId) {
        //     $content = "FAQ Like Id not found!" . " FAQ ID: " . $faqId;
        // } else {
        //     $content = "FAQ Like updated!" . " FAQ ID: " . $faqId;
        // }

        
        // $response = new Response($content);         
        // return $response;
    }
}