<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\services\RedirectHandler;

class TokenHandler extends RedirectHandler {

    public function generateCsrfToken() : void
    {
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time();
    }

    public function csrfTokenCheck(string $formTokenInput) : void 
    {
        if(isset($_SESSION['csrf_token']) && isset($_SESSION['csrf_token_time'])) {
            $oldTimestamp = time() - (30*60);
            if($formTokenInput === $_SESSION['csrf_token'] && $_SESSION['csrf_token_time'] >= $oldTimestamp) {
                unset($_SESSION['csrf_token']);
                unset($_SESSION['csrf_token_time']);
            } else {
                $_SESSION['error'] = "Un problème a été rencontré lors de la correspondance des données, veuillez recommencer.";
                parent::redirect('forbidden#forbidden_page');
            }
        } else {
            $_SESSION['error'] = "Un problème a été rencontré lors de la correspondance, veuillez recommencer.";
            parent::redirect('forbidden#forbidden_page');
        }
    }
}
