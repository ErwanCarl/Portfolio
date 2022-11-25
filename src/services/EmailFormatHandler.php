<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\entity\User;
use App\services\Manager;

class EmailFormatHandler extends Manager {

    public function emailFormatCheck(User $user) : string
    {
        $email = $user->getMail();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "L'email entré n'est pas au bon format.";
            return $this->redirectTo('accountcreation');
            // header('Location: /accountcreation');
            // exit();
        }
    }
}
