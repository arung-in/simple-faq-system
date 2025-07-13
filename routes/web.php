<?php

use App\Controllers\FaqController;

return [
    ['GET', '/', [FaqController::class, 'index']],
    ['GET', '/faqs/{id:\d+}', [FaqController::class, 'faqLike']]
    
];