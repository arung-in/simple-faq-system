<?php

use App\Controllers\FaqController;

return [
    ['GET', '/', [FaqController::class, 'index']],
    ['POST', '/faqs-api/like', [FaqController::class, 'faqLike']]
    // ['POST', '/faqs-api/like/{faqId:\d+}', [FaqController::class, 'faqLike']]
];