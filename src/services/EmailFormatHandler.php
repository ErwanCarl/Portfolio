<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\entity\User;
use App\services\RedirectHandler;

class EmailFormatHandler extends RedirectHandler {

    public function emailFormatCheck(User $user) : void
    {
        $email = $user->getMail();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "L'email entré n'est pas au bon format.";
            parent::redirect('accountcreation');
        }
    }
}
