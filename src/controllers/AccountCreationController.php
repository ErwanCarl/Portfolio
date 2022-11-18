<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\services\TokenHandler;

class AccountCreationController 
{
    public function accountCreation() : void 
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();

        require(TEMPLATE_DIR.'/accountCreation.php');
    }

    public function accountClosingSession() : void 
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->generateCsrfToken();

        $_SESSION['success'] = 'Vous vous êtes bien déconnecté.';

        require(TEMPLATE_DIR.'/accountCreation.php');
    }
}
